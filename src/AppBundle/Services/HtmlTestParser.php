<?php

namespace AppBundle\Services;

use AppBundle\Utils\PregUtil;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPHtmlParser\Dom;

class HtmlTestParser
{
    /**
     * @var Dom
     */
    private $domParser;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * HtmlTestParser constructor.
     */
    public function __construct(EntityManagerInterface $em)
    {
        $domParser = new Dom();
        $this->domParser = $domParser;
        $this->em = $em;
    }

    private function getTestData($url, $category = 1, $subCategory = 1)
    {
        $testHtml = file_get_contents($url);
        $this->domParser->load($testHtml);

        $header = $this->domParser->find('h1[itemprop="name"]')->text();
        $description= $this->domParser->find('h2[itemprop="description"]')->text();

        $resultTestData = [
            'name' => PregUtil::pregText(html_entity_decode($header, ENT_QUOTES)),
            'desc' => PregUtil::pregText(html_entity_decode($description, ENT_QUOTES)),
            'testImage' => '',
            'category' => $category,
            'subCategory' => $subCategory,
            'questions' => []
        ];

        $questionsHtml = $this->domParser->find('.questions');

        for($i = 0; $i < count($questionsHtml); $i++) {
            $question = PregUtil::pregText(html_entity_decode($questionsHtml[$i]->find('.frage')->find('fieldset')->find('div')->text(), ENT_QUOTES));

            $labelsHtml = $questionsHtml[$i]->find('.antworten')->find('label');
            $inputsHtml = $questionsHtml[$i]->find('.antworten')->find('input');

            $answers = [];
            for($x = 0; $x < count($labelsHtml); $x++) {
                $answers[] = [
                    'text' => PregUtil::pregText(html_entity_decode($labelsHtml[$x]->text(), ENT_QUOTES)),
                    'value' => $inputsHtml[$x]->getAttribute('value')
                ];
            }

            $resultTestData['questions'][] = [
                'text' => $question,
                'answers' => $answers
            ];

        }

        return $resultTestData;
    }

    private function sendCurlForTestResult($testResultUrl, $postFields)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$testResultUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);

        return $server_output;
    }

    private function getHiddenFields($url)
    {
        $testHtml = file_get_contents($url);
        $this->domParser->load($testHtml);

        $hiddenHtml = $this->domParser->find('#mainContent')->find('form')->find('input[type="hidden"]');

        $result = [];

        for($i = 0; $i < count($hiddenHtml); $i++) {
            if(is_int(+$hiddenHtml[$i]->getAttribute('value'))) {
                $val = +$hiddenHtml[$i]->getAttribute('value');
            } else {
                $val = $hiddenHtml[$i]->getAttribute('value');
            }

            $result[$hiddenHtml[$i]->getAttribute('name')] = $val;
        }

        return $result;
    }

    private function getInputValues($url)
    {
        $testHtml = file_get_contents($url);
        $this->domParser->load($testHtml);

        $inputs = [];

        $questionsHtml = $this->domParser->find('.questions');

        for($i = 0; $i < count($questionsHtml); $i++) {
            $inputsHtml = $questionsHtml[$i]->find('.antworten')->find('input');

            $possiblyValues = [];

            for($x = 0; $x < count($inputsHtml); $x++) {
                $possiblyValues[] = +$inputsHtml[$x]->getAttribute('value');
            }

            $inputs[$inputsHtml[0]->getAttribute('name')] = $possiblyValues;

        }

        return $inputs;
    }

    private function formTestResultArray($inputValues, $percentage = 1)
    {
        $res = [];

        $max = 0;
        foreach ($inputValues as $input => $value) {
            $val = max($value);
            $max += $val;
        }

        $percent = round($max * $percentage);

        $counted = 0;
        foreach ($inputValues as $input => $value) {
            $val = max($value);

            if($percent < $counted) {
                $val = min($value);
            }

            $counted += $val;
            $res[$input] = $val;
        }

        $result = [
            'postArray' => $res,
            'countedValue' => $counted
        ];

        return $result;
    }

    private function formHttpFields($data)
    {
        return http_build_query($data);
    }

    private function merge($hidden, $result)
    {
        return array_merge($hidden, $result);
    }

    private function sendRequestForTestResult($url, $percentage)
    {
        $hiddenFields = $this->getHiddenFields($url);
        $inputValues = $this->getInputValues($url);
        $formTestResult = $this->formTestResultArray($inputValues, $percentage);
        $merged = $this->merge($hiddenFields, $formTestResult['postArray']);
        $http = $this->formHttpFields($merged);

        $res = $this->sendCurlForTestResult($url, $http);

        $result = [
            'res' => $res,
            'countedValue' => $formTestResult['countedValue']
        ];

        return $result;
    }

    private function parseResponse($result)
    {
        $dom = new Dom();
        $dom->load($result['res']);

        $text = $dom->find('div[id="certificateText"]')->find('p')->text();

        $result = [
            'text' => html_entity_decode($text, ENT_QUOTES),
            'value' => $result['countedValue']
        ];

        return $result;
    }

    private function getTestResults($url)
    {
        $percents = [0,0.15,0.3,0.45,0.6,0.75,0.9,1];

        $result = [];

        for($i = 0; $i < count($percents); $i++) {
            $req = $this->sendRequestForTestResult($url, $percents[$i]);
            $res = $this->parseResponse($req);

            $resText = $res['text'];

            if(!array_key_exists($resText, $result)) {
                $result[$resText] = [
                    'text' => $resText,
                    'value' => $res['value'],
                    'image' => ''
                ];
            }
        }

        return $result;
    }

    public function parseTest($url, $category = 1, $subCategory = 1)
    {
        $testData = $this->getTestData($url, $category, $subCategory);
        $results = $this->getTestResults($url);

        $testData['results'] = $results;

        return $testData;
    }

    public function getAvailableAmount($categories, $isForParse = true)
    {
        $connection = $this->em->getConnection();
        $result = [];


        if($isForParse) {
            $sql = '
        SELECT COUNT(id) as amount, category_id FROM parsed_links WHERE category_id = :catId AND is_added = :status
        ';
        } else {
            $sql = '
        SELECT COUNT(id) as amount, category_id FROM test_item WHERE category_id = :catId
        ';
        }


        foreach ($categories as $category) {

            if($isForParse) {
                $params = [
                    'catId' => $category->getId(),
                    'status' => 0
                ];
            } else {
                $params = [
                    'catId' => $category->getId()
                ];
            }

            $query = $connection->prepare($sql);
            $query->execute($params);
            $result[] = $query->fetch();
        }

        return $result;
    }
}
