<?php

namespace AppBundle\Factory\UserStatistic;

use AppBundle\Entity\UserStatistic\SavedTests;

/**
 * Class SavedTestsFactory
 * @package App\Factory\UserStatistic
 */
class SavedTestsFactory
{
    /**
     * @param $userId
     * @param $testId
     * @return SavedTests
     */
    public function create($userId, $testId)
    {
        $savedTest = new SavedTests();

        $savedTest
            ->setTestId($testId)
            ->setUserId($userId);

        return $savedTest;
    }

}
