<?php

namespace AppBundle\Factory\UserStatistic;

use AppBundle\Entity\UserStatistic\Passed;

class PassedFactory
{
    public function create($testId)
    {
        $passed = new Passed();

        $passed
            ->setPassedTime(new \DateTime())
            ->setTestId($testId);

        return $passed;
    }
}
