<?php

namespace AppBundle\Services;

use AppBundle\Entity\Log;
use AppBundle\Entity\Others\Keyword;
use AppBundle\Entity\Tests\SubCategory;
use AppBundle\Entity\Tests\TestItem;
use AppBundle\Entity\Tests\TestItemAnswers;
use AppBundle\Entity\Tests\TestItemQuestions;
use AppBundle\Entity\Tests\TestItemResults;
use AppBundle\Entity\Tests\Categories;
use AppBundle\Factory\TestItemAnswersFactory;
use AppBundle\Factory\TestItemFactory;
use AppBundle\Factory\TestItemQuestionsFactory;
use AppBundle\Factory\TestItemResultsFactory;
use AppBundle\Manager\TestItemAnswersManager;
use AppBundle\Manager\TestItemManager;
use AppBundle\Manager\TestItemQuestionsManager;
use AppBundle\Manager\TestItemResultsManager;
use AppBundle\Model\ServiceResponse;
use AppBundle\Utils\LogUtil;
use Doctrine\ORM\EntityManager;

class TestItemService
{
    /**
     * @var TestItemFactory
     */
    private $testItemFactory;

    /**
     * @var TestItemQuestionsFactory
     */
    private $testItemQuestionsFactory;

    /**
     * @var TestItemAnswersFactory
     */
    private $testItemAnswersFactory;

    /**
     * @var TestItemResultsFactory
     */
    private $testItemResultsFactory;

    /**
     * @var TestItemManager
     */
    private $testItemManager;

    /**
     * @var TestItemQuestionsManager
     */
    private $testItemQuestionsManager;

    /**
     * @var TestItemAnswersManager
     */
    private $testItemAnswersManager;

    /**
     * @var TestItemResultsManager
     */
    private $testItemResultsManager;

    /**
     * @var LogService
     */
    private $logger;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * TestItemService constructor.
     * @param TestItemFactory $testItemFactory
     * @param TestItemQuestionsFactory $testItemQuestionsFactory
     * @param TestItemAnswersFactory $testItemAnswersFactory
     * @param TestItemResultsFactory $testItemResultsFactory
     * @param TestItemManager $testItemManager
     * @param TestItemQuestionsManager $testItemQuestionsManager
     * @param TestItemAnswersManager $testItemAnswersManager
     * @param TestItemResultsManager $testItemResultsManager
     * @param LogService $logger
     * @param EntityManager $em
     */
    public function __construct(
        TestItemFactory $testItemFactory,
        TestItemQuestionsFactory $testItemQuestionsFactory,
        TestItemAnswersFactory $testItemAnswersFactory,
        TestItemResultsFactory $testItemResultsFactory,
        TestItemManager $testItemManager,
        TestItemQuestionsManager $testItemQuestionsManager,
        TestItemAnswersManager $testItemAnswersManager,
        TestItemResultsManager $testItemResultsManager,
        LogService $logger,
        EntityManager $em
    )
    {
        $this->testItemFactory = $testItemFactory;
        $this->testItemQuestionsFactory = $testItemQuestionsFactory;
        $this->testItemAnswersFactory = $testItemAnswersFactory;
        $this->testItemResultsFactory = $testItemResultsFactory;
        $this->testItemManager = $testItemManager;
        $this->testItemQuestionsManager = $testItemQuestionsManager;
        $this->testItemAnswersManager = $testItemAnswersManager;
        $this->testItemResultsManager = $testItemResultsManager;
        $this->logger = $logger;
        $this->em = $em;
    }

    public function addTest($testData)
    {
        $testItem = $this->testItemFactory->create($testData['name'], $testData['desc'], $testData['testImage'], $testData['category'], $testData['subCategory']);
        try {
            $this->testItemManager->save($testItem);
        } catch (\Exception $e) {
            return [ServiceResponse::ERROR, $e->getMessage()];
        }

        $testItemQuestions = $testData['questions'];

        foreach ($testItemQuestions as $question) {
            $questionText = $question['text'];
            $answers = $question['answers'];

            $ques = $this->testItemQuestionsFactory->create($testItem->getId(), $questionText);
            try {
                $this->testItemQuestionsManager->save($ques);
            } catch (\Exception $e) {
                return [ServiceResponse::ERROR, $e->getMessage()];
            }

            foreach ($answers as $answer) {
                $answerText = $answer['text'];
                $value = $answer['value'];

                $ans = $this->testItemAnswersFactory->create($ques->getId(), $value, $answerText);

                try {
                    $this->testItemAnswersManager->save($ans);
                } catch (\Exception $e) {
                    return [ServiceResponse::ERROR, $e->getMessage()];
                }
            }
        }

        $testItemResults = $testData['results'];

        foreach ($testItemResults as $result) {
            $text = $result['text'];
            $value = $result['value'];
            $image = $result['image'];

            $resultItem = $this->testItemResultsFactory->create($testItem->getId(), $value, $text, $image);

            try {
                $this->testItemResultsManager->save($resultItem);
            } catch (\Exception $e) {
                return [ServiceResponse::ERROR, $e->getMessage()];
            }
        }

        return [ServiceResponse::SUCCESS];
    }

    public function getTestById($id)
    {
        /** @var TestItem $query */
        $query = $this->em->getRepository(TestItem::class)->getTestById($id);

        $test = [
            'test' => [],
            'questions' => [],
            'answers' => [],
            'results' => []
        ];

        foreach ($query as $element) {

            if ($element instanceof TestItem) {
                $test['test'] = $element;
            }

            if ($element instanceof TestItemQuestions) {
                $test['questions'][] = $element;
            }

            if ($element instanceof TestItemAnswers) {
                $test['answers'][] = $element;
            }

            if ($element instanceof TestItemResults) {
                $test['results'][] = $element;
            }

        }

        return $test;
    }

    public function getTestsByCategory($categoryId, $isChecked = 1)
    {
        /** @var TestItem $query */
        $query = $this->em->getRepository(TestItem::class)->getTestsByCategory($categoryId, $isChecked);

        return $query;
    }

    public function getCategories()
    {
        $categories = $this->em->getRepository(Categories::class)->getCategories();

        return $categories;
    }

    public function getAllTests()
    {
        /** @var TestItem $query */
        $query = $this->em->getRepository(TestItem::class)->getAllTests();

        return $query;
    }

    public function getResultOfTest($resultData, $testId)
    {
        $totalSum = 0;

        foreach ($resultData as $answer) {
            $answer = $this->em->getRepository(TestItemAnswers::class)->findOneBy(['id'=> $answer]);

            $totalSum += $answer->getValue();
        }

        $start = $totalSum * 0.8;

        $result = $this->em->getRepository(TestItem::class)->getResultOfTest($testId, $start, $totalSum);

        if(empty($result)) {
            $result = $this->em->getRepository(TestItem::class)->getResultOfTest($testId, 0, 9999);
        }

        return $result[0];
    }

    public function addPassedCount($testId)
    {
        /** @var TestItem $test */
        $test = $this->em->getRepository(TestItem::class)->findOneBy(['id' => $testId]);

        $current = $test->getPassedCount();
        ++$current;

        $test->setPassedCount($current);

        $this->testItemManager->save($test);
    }

    public function getTestsByQuery($query, $category = null)
    {
        return $this->em->getRepository(TestItem::class)->getTestsByQuery($query, $category);
    }

    public function deleteTest($id)
    {
        $test = $this->em->getRepository(TestItem::class)->getTestById($id);

        foreach ($test as $element) {
            try {
                $this->em->remove($element);
                $this->em->flush();
            } catch (\Exception $e) {
                return ServiceResponse::ERROR;
            }
        }

        return ServiceResponse::SUCCESS;
    }

    public function setIsChecked($id,$value)
    {
       $test = $this->em->getRepository(TestItem::class)->findOneBy(['id' => $id]);

       $test->setIsChecked($value);

       try {
           $this->em->persist($test);
           $this->em->flush();
       } catch (\Exception $e) {
           return ServiceResponse::ERROR;
       }

       return ServiceResponse::SUCCESS;
    }

    public function updateTest($testData)
    {
        $testId = $testData['header']['id'];
        $header = $testData['header']['text'];
        $desc = $testData['desc']['text'];
        $mainImage = $testData['mainImage']['url'];
        $imageUrl = $testData['imageUrl']['url'];

        /** @var TestItem $testItem */
        $testItem = $this->em->getRepository(TestItem::class)->findOneBy(['id' => $testId]);

        $testItem
            ->setName($header)
            ->setDescription($desc)
            ->setMainImage($mainImage)
            ->setImageUrl($imageUrl);

        $this->em->persist($testItem);
        $this->em->flush();

        foreach ($testData['questions'] as $question) {
            /** @var TestItemQuestions $ques */
            $ques = $this->em->getRepository(TestItemQuestions::class)->findOneBy(['id' => $question['id']]);

            $ques->setDescription($question['text']);

            $this->em->persist($ques);
            $this->em->flush();
        }

        foreach ($testData['answers'] as $answer) {
            /** @var TestItemAnswers $ans */
            $ans = $this->em->getRepository(TestItemAnswers::class)->findOneBy(['id' => $answer['id']]);

            $ans->setText($answer['text']);

            $this->em->persist($ans);
            $this->em->flush();

        }

        foreach ($testData['results'] as $result) {
            /** @var TestItemResults $res */
            $res = $this->em->getRepository(TestItemResults::class)->findOneBy(['id' => $result['id']]);

            $res->setText($result['text']);

            $this->em->persist($res);
            $this->em->flush();
        }

        foreach ($testData['resultsImgs'] as $resultImg) {
            /** @var TestItemResults $res */
            $res = $this->em->getRepository(TestItemResults::class)->findOneBy(['id' => $resultImg['id']]);

            $res->setImageUrl($resultImg['url']);

            $this->em->persist($res);
            $this->em->flush();
        }

        return ServiceResponse::SUCCESS;
    }

    public function getTestIdByUrlName($name)
    {
        $test = $this->em->getRepository(TestItem::class)->findOneBy(['urlName' => $name]);

        return $test->getId();
    }

    public function getAllNonCheckedTests()
    {
        return $tests = $this->em->getRepository(TestItem::class)->getAllNonCheckedTests();
    }

    public function getPopularTests()
    {
        return $this->em->getRepository(TestItem::class)->getPopularTests();
    }

    public function getKeywords($category = null)
    {
        $query = $this->em->getRepository(Keyword::class)->getKeywords($category);

        $keywords = [];

        if(!empty($query)) {
            for ($i = 0; $i < count($query); $i++) {
                $keywords[] = $query[$i]['keyword'];
            }
        }

        shuffle($keywords);

        if(count($keywords) > 100) {
            array_slice($keywords, 0, 100);
        }

        return $keywords;
    }

    public function getCategory($id)
    {
        return $this->em->getRepository(Categories::class)->getCategory($id);
    }

    public function getSubCategories($category = null)
    {
        return $this->em->getRepository(SubCategory::class)->getSubCategories($category);
    }

    public function getTestsBySubId($id)
    {
        return $this->em->getRepository(TestItem::class)->getTestsBySubId($id);
    }
}
