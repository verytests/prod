<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Tests\TestItemResults;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TestItemResultsManager
 * @package App\Manager
 */
class TestItemResultsManager
{
    private $em;

    /**
     * TestItemResultsManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * Saves an Test Item Result entity
     *
     * @param TestItemResults $testItemResults
     * @return TestItemResults
     */
    public function save(TestItemResults $testItemResults)
    {
        $this->em->persist($testItemResults);
        $this->em->flush();

        return $testItemResults;
    }
}
