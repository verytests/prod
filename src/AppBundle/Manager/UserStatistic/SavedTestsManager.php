<?php

namespace AppBundle\Manager\UserStatistic;

use AppBundle\Entity\UserStatistic\SavedTests;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class SavedTestsManager
 * @package App\Manager\UserStatistic
 */
class SavedTestsManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * SavedTestsManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param SavedTests $savedTests
     * @return SavedTests
     */
    public function save(SavedTests $savedTests)
    {
        $this->em->persist($savedTests);
        $this->em->flush();

        return $savedTests;
    }
}
