<?php

namespace AppBundle\Factory\UserStatistic;

use AppBundle\Entity\UserStatistic\RecentTests;

/**
 * Class RecentTestsFactory
 * @package App\Factory\UserStatistic
 */
class RecentTestsFactory
{
    public function create($userId, $testId)
    {
        $recentTest = new RecentTests();

        $recentTest
            ->setTestId($testId)
            ->setUserId($userId);

        return $recentTest;
    }
}
