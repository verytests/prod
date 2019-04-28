<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Tests\TestItem;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TestItemManager
 * @package App\Manager
 */
class TestItemManager
{

    private $em;

    /**
     * TestItemManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Saves an test item entity
     *
     * @param TestItem $testItem
     * @return TestItem
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(TestItem $testItem)
    {
        $this->em->persist($testItem);
        $this->em->flush();

        return $testItem;
    }

}
