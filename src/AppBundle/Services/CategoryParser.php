<?php

namespace AppBundle\Services;

use AppBundle\Entity\Others\Keyword;
use AppBundle\Entity\Others\ParsedLink;
use Doctrine\ORM\EntityManager;
use PHPHtmlParser\Dom;

class CategoryParser
{
    /**
     * @var Dom
     */
    private $domParser;

    /**
     * @var HtmlTestParser
     */
    private $htmlTestParser;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * CategoryParser constructor.
     * @param HtmlTestParser $htmlTestParser
     * @param EntityManager $em
     */
    public function __construct(HtmlTestParser  $htmlTestParser, EntityManager $em)
    {
        $domParser = new Dom();
        $this->domParser = $domParser;
        $this->htmlTestParser = $htmlTestParser;
        $this->em = $em;
    }

    public function getSubCategoriesLinks($url, $start = 0, $end = 5)
    {
        $testHtml = file_get_contents($url);
        $this->domParser->load($testHtml);

        $categories = $this->domParser->find('div[class="category"]');

        $links = [];

        foreach($categories as $category) {
            $lis = $category->find('ul')->find('li');

            if((count($lis)) < $end) {
                $end = count($lis);
            }

            for($i = $start; $i < $end; $i++) {
                $link = $lis[$i]->find('a')->getAttribute('href');

                $check = $this->em->getRepository(ParsedLink::class)->findOneBy(['parsedCategoryName' => $lis[$i]->find('a')->text()]);

                if(!$check) {
                    $links[] = [
                        'link' => 'https://www.allthetests.com'. $link,
                        'category' => $lis[$i]->find('a')->text()
                    ];
                }
            }

        }

        return $links;
    }

    public function getPaginationLinks($url)
    {
        $testHtml = file_get_contents($url);
        $this->domParser->load($testHtml);

        $pagination = $this->domParser->find('div[id="paging"]');

        if(empty($pagination)) {
            return [];
        }

        $lis = $pagination->find('a');

        $links = [];
        for($i = 0; $i < count($lis); $i++) {
            $link = $lis[$i]->getAttribute('href');

            $links[] = 'https://www.allthetests.com'.$link;
        }

        return $links;
    }

    public function getTestLinks($url, $parsedCategory = 'others', $takers = 10)
    {
        $testHtml = file_get_contents($url);
        $this->domParser->load($testHtml);

        $articles = $this->domParser->find('article[class="latestEntry"]');

        $links = [];
        for($i = 0; $i < count($articles); $i++) {
            $metaText = $articles[$i]->find('div[class="entryText"]')->find('div[class="metadata"]')->find('div[class="metaText"]');
            $string = $metaText[1]->text();
            $arr = explode('Developed on:', $string);

            if(!empty($arr[1])) {
                $str = $arr[1];
            } else {
                continue;
            }

            $arr = explode(' - ', $str);
            $num = (int)$arr[1];

            if($num > $takers) {
                $a = $articles[$i]->find('div[class="entryText"]')->find('h3')->find('a')->getAttribute('href');
                $link = 'https://www.allthetests.com'.$a;

                $this->em->getRepository(ParsedLink::class)->findBy(['link' => $link]);

                if(!$link) {
                    $links[] = [
                        'link' => $link,
                        'category' => $parsedCategory
                    ];
                }

            } else {
                continue;
            }
        }

        return $links;
    }

    public function checkTest($url)
    {
        $testHtml = file_get_contents($url);
        $this->domParser->load($testHtml);

        $questions = $this->domParser->find('ul[class="questions"]');

        if(count($questions) < 5) {
            return false;
        }

        return true;
    }

    public function parseCategory($url, $categoryId, $start = 0, $end = 5)
    {
        $subCategoriesLinks = $this->getSubCategoriesLinks($url, $start, $end);

        $testLinks = [];

        foreach ($subCategoriesLinks as $subCatLink) {
            $paginationLinks = $this->getPaginationLinks($subCatLink['link']);

            if(empty($paginationLinks)) {
                $testUrls = $this->getTestLinks($subCatLink['link'], $subCatLink['category']);

                $this->parseHeadersForKeywords($subCatLink['link'], $categoryId);

                foreach ($testUrls as $testUrl) {
                    if($this->checkTest($testUrl['link'])) {
                        $testLinks[] = $testUrl;
                    } else {
                        continue;
                    }
                }
            } else {

                foreach ($paginationLinks as $pagLink) {
                    $testUrls = $this->getTestLinks($pagLink, $subCatLink['category']);

                    $this->parseHeadersForKeywords($pagLink, $categoryId);

                    foreach ($testUrls as $testUrl) {
                        if($this->checkTest($testUrl['link'])) {
                            $testLinks[] = $testUrl;
                        } else {
                            continue;
                        }
                    }
                }

            }

        }

        return $this->createParsedLinks($testLinks, $categoryId);
    }

    public function parseSubCategory($url, $categoryId, $subCategory)
    {
        $paginationLinks = $this->getPaginationLinks($url);
        $testLinks = [];

        if(empty($paginationLinks)) {
            $testUrls = $this->getTestLinks($url, $subCategory);

            $this->parseHeadersForKeywords($url, $categoryId);

            foreach ($testUrls as $testUrl) {
                if($this->checkTest($testUrl['link'])) {
                    $testLinks[] = $testUrl;
                } else {
                    continue;
                }
            }
        } else {
            foreach ($paginationLinks as $pagLink) {
                $testUrls = $this->getTestLinks($pagLink, $subCategory);

                $this->parseHeadersForKeywords($pagLink, $categoryId);

                foreach ($testUrls as $testUrl) {
                    if($this->checkTest($testUrl['link'])) {
                        $testLinks[] = $testUrl;
                    } else {
                        continue;
                    }
                }
            }
        }

        return $this->createParsedLinks($testLinks, $categoryId);
    }

    public function createParsedLinks($links, $categoryId)
    {
        foreach ($links as $item) {
            $link = new ParsedLink();

            $link
                ->setCategoryId($categoryId)
                ->setIsAdded(false)
                ->setLink($item['link'])
                ->setParsedCategoryName($item['category']);

            $this->em->persist($link);
            $this->em->flush();
        }

        return true;
    }

    public function parseHeadersForKeywords($url, $categoryId)
    {
        $testHtml = file_get_contents($url);
        $this->domParser->load($testHtml);

        $articles = $this->domParser->find('article[class="latestEntry"]');
        $header = $articles->find('div[class="entryText"]')->find('h3')->find('a')->text();

        $arr = explode(' ', $header);

        foreach ($arr as $word) {
            if((strlen($word)) > 3) {

                $lowered = strtolower($word);
                $res = html_entity_decode($lowered, ENT_QUOTES);

                $check = $this->em->getRepository(Keyword::class)->findOneBy(['keyword' => $res, 'categoryId' => $categoryId]);

                if(!$check) {
                    $keyword = new Keyword();
                    $keyword
                        ->setCategoryId($categoryId)
                        ->setKeyword($res);

                    $this->em->persist($keyword);
                    $this->em->flush();
                }
            } else {
                continue;
            }
        }

        return true;
    }
}
