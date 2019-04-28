<?php

namespace AppBundle\Services;

use AppBundle\Entity\Tests\TestItem;
use AppBundle\Entity\UserStatistic\RecentTests;
use AppBundle\Entity\UserStatistic\SavedTests;
use AppBundle\Factory\UserStatistic\PassedFactory;
use AppBundle\Factory\UserStatistic\RecentTestsFactory;
use AppBundle\Factory\UserStatistic\SavedTestsFactory;
use AppBundle\Manager\UserStatistic\PassedManager;
use AppBundle\Manager\UserStatistic\RecentTestsManager;
use AppBundle\Manager\UserStatistic\SavedTestsManager;
use AppBundle\Model\ServiceResponse;
use Doctrine\ORM\EntityManager;

class UserStatisticService
{
    /**
     * @var LogService
     */
    private $logger;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var RecentTestsFactory
     */
    private $recentTestFactory;

    /**
     * @var SavedTestsFactory
     */
    private $savedTestFactory;

    /**
     * @var RecentTestsManager
     */
    private $recentTestManager;

    /**
     * @var SavedTestsManager
     */
    private $savedTestManager;

    private $passedFactory;

    private $passedManager;

    public function __construct(
        LogService $logger,
        EntityManager $em,
        RecentTestsFactory $recentTestFactory,
        SavedTestsFactory $savedTestFactory,
        RecentTestsManager $recentTestManager,
        SavedTestsManager $savedTestManager,
        PassedFactory $passedFactory,
        PassedManager $passedManager
    )
    {
        $this->logger = $logger;
        $this->em = $em;
        $this->recentTestFactory = $recentTestFactory;
        $this->savedTestFactory = $savedTestFactory;
        $this->recentTestManager = $recentTestManager;
        $this->savedTestManager = $savedTestManager;
        $this->passedFactory = $passedFactory;
        $this->passedManager = $passedManager;
    }

    public function addRecentTest($userId, $testId)
    {
        $recentTest = $this->recentTestFactory->create($userId, $testId);

        $this->recentTestManager->save($recentTest);

        return ServiceResponse::SUCCESS;
    }

    public function addSavedTest($userId, $testId)
    {
        $savedTest = $this->savedTestFactory->create($userId, $testId);

        $this->savedTestManager->save($savedTest);

        return ServiceResponse::SUCCESS;
    }

    public function getRecentTests($userId)
    {
        $recentTestsQuery = $this->em->getRepository(RecentTests::class)->getRecentTests($userId);

        $recentTests = [];

        if(!empty($recentTestsQuery)) {
            foreach ($recentTestsQuery as $query) {
                $test = $this->em->getRepository(TestItem::class)->getTestItemById($query->getTestId());

                $recentTests[] = $test[0];
            }
        }

        return $recentTests;
    }

    public function getSavedTests($userId)
    {
        $savedTestsQuery = $this->em->getRepository(SavedTests::class)->getSavedTests($userId);

        $savedTests = [];

        foreach ($savedTestsQuery as $query) {
            $test = $this->em->getRepository(TestItem::class)->getTestItemById($query->getTestId());

            $savedTests[] = $test[0];
        }

        return $savedTests;
    }

    public function getSavedTestsItems($userId)
    {
        $savedTests = $this->em->getRepository(SavedTests::class)->getSavedTests($userId);

        return $savedTests;
    }

    public function getRecentTestItemById($userId, $id)
    {
        $recent = $this->em->getRepository(RecentTests::class)->getRecentTestItemById($userId, $id);

        return $recent;
    }

    public function getMonthStatistic()
    {
        $sql = "
            SELECT DISTINCT test_id, t.passed_count
            FROM passed 
            INNER JOIN test_item as t
            ON t.id = test_id
            WHERE passed_time BETWEEN :start AND :end ORDER BY t.passed_count DESC LIMIT 3
        ";

        $conn = $this->em->getConnection();

        $dayParams = [
            'start' => (new \DateTime('2 day ago'))->format('Y-m-d'),
            'end' => (new \DateTime())->format('Y-m-d')
        ];

        $weekParams = [
            'start' => (new \DateTime('1 week ago'))->format('Y-m-d'),
            'end' => (new \DateTime())->format('Y-m-d')
        ];

        $monthParams = [
            'start' => (new \DateTime('1 month ago'))->format('Y-m-d'),
            'end' => (new \DateTime())->format('Y-m-d')
        ];

        $dayQuery = $conn->prepare($sql);
        $dayQuery->execute($dayParams);

        $weekQuery = $conn->prepare($sql);
        $weekQuery->execute($weekParams);

        $monthQuery = $conn->prepare($sql);
        $monthQuery->execute($monthParams);

        $dayId = $dayQuery->fetchAll();
        $weekId = $weekQuery->fetchAll();
        $monthId = $monthQuery->fetchAll();

        $day = [];
        $week = [];
        $month = [];

        foreach ($dayId as $d) {
            $day[] = $this->em->getRepository(TestItem::class)->findOneBy(['id' => $d['test_id']]);
        }

        foreach ($weekId as $w) {
            $week[] = $this->em->getRepository(TestItem::class)->findOneBy(['id' => $w['test_id']]);
        }

        foreach ($monthId as $m) {
            $month[] = $this->em->getRepository(TestItem::class)->findOneBy(['id' => $m['test_id']]);
        }

        return [
          'day' => $day,
          'week' => $week,
          'month' => $month
        ];
    }

    public function addPassed($testId)
    {
        $passed = $this->passedFactory->create($testId);

        $this->passedManager->save($passed);
    }
}
