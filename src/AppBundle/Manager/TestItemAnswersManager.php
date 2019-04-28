<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Tests\TestItemAnswers;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TestItemAnswersManager
 * @package App\Manager
 */
class TestItemAnswersManager
{

    private $em;

    /**
     * TestItemAnswersManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Saves a test item answers entity
     *
     * @param TestItemAnswers $testItemAnswers
     * @return TestItemAnswers
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(TestItemAnswers $testItemAnswers)
    {
        $this->em->persist($testItemAnswers);
        $this->em->flush();

        return $testItemAnswers;
    }
}
