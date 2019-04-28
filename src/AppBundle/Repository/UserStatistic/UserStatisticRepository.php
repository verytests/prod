<?php

namespace AppBundle\Repository\UserStatistic;


use AppBundle\Entity\Tests\TestItem;
use AppBundle\Entity\UserStatistic\RecentTests;
use AppBundle\Entity\UserStatistic\SavedTests;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\DependencyInjection\Tests\Compiler\D;

class UserStatisticRepository extends EntityRepository
{
    public function getRecentTests($userId)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('rt')
            ->from(RecentTests::class, 'rt')
            ->where('rt.userId = :userId')
            ->setParameter('userId', $userId);

        return $qb
                ->getQuery()
                ->getResult();
    }

    public function getSavedTests($userId)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('st')
            ->from(SavedTests::class, 'st')
            ->where('st.userId = :userId')
            ->setParameter('userId', $userId);

        return $qb
            ->getQuery()
            ->getResult();
    }

    public function getRecentTestItemById($userId, $id)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('rt')
            ->from(RecentTests::class, 'rt')
            ->where('rt.userId = :userId')
            ->andWhere('rt.testId = :id')
            ->setParameter('id', $id)
            ->setParameter('userId', $userId);

        return $qb
            ->getQuery()
            ->getResult();
    }
}
