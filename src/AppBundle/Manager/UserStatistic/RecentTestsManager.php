<?php

namespace AppBundle\Manager\UserStatistic;

use AppBundle\Entity\UserStatistic\RecentTests;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class RecentTestsManager
 * @package App\Manager\UserStatistic
 */
class RecentTestsManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * RecentTestsManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param RecentTests $recentTests
     * @return RecentTests
     */
    public function save(RecentTests $recentTests)
    {
        $this->em->persist($recentTests);
        $this->em->flush();

        return $recentTests;
    }
}
