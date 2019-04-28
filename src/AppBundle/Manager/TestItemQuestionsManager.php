<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Tests\TestItemQuestions;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TestItemQuestionsManager
 * @package App\Manager
 */
class TestItemQuestionsManager
{

    private $em;

    /**
     * TestItemQuestionsManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Save an test item questions entity
     *
     * @param TestItemQuestions $testItemQuestions
     * @return TestItemQuestions
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(TestItemQuestions $testItemQuestions)
    {
        $this->em->persist($testItemQuestions);
        $this->em->flush();

        return $testItemQuestions;
    }
}
