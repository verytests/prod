<?php

namespace AppBundle\Manager\UserStatistic;

use AppBundle\Entity\UserStatistic\Passed;
use Doctrine\ORM\EntityManagerInterface;

class PassedManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function save(Passed $passed)
    {
        $this->em->persist($passed);
        $this->em->flush();

        return $passed;
    }
}
