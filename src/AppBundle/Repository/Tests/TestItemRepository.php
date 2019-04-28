<?php

namespace AppBundle\Repository\Tests;

use AppBundle\Entity\Tests\TestItem;
use AppBundle\Entity\Tests\TestItemAnswers;
use AppBundle\Entity\Tests\TestItemQuestions;
use AppBundle\Entity\Tests\TestItemResults;
use Doctrine\ORM\EntityRepository;

/**
 * Class TestItemRepository
 * @package App\Repository\Tests
 */
class TestItemRepository extends EntityRepository
{
    /**
     * Get all test data by id
     *
     * @param $id
     * @return mixed
     */
    public function getTestById($id)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb
            ->select('t,a,q,r')
            ->from(TestItem::class, 't')
            ->innerJoin(TestItemAnswers::class, 'a')
            ->innerJoin(TestItemQuestions::class, 'q')
            ->innerJoin(TestItemResults::class,'r')
            ->where('t.id = q.testId')
            ->andWhere('t.id = r.testId')
            ->andWhere('q.id = a.questionId')
            ->andWhere('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    /**
     * Get test data by category id
     *
     * @param $categoryId
     * @param int $isChecked
     * @return mixed
     */
    public function getTestsByCategory($categoryId, $isChecked = 1)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('t')
            ->from(TestItem::class, 't')
            ->where('t.categoryId = :categoryId')
            ->setParameter('categoryId', $categoryId)
            ->andWhere('t.isChecked = :isChecked')
            ->setParameter('isChecked', $isChecked);


        return $qb
            ->orderBy('t.passedCount', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function getAllTests($isChecked = 1)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('t')
            ->from(TestItem::class, 't')
            ->orderBy('t.passedCount', 'DESC')
            ->andWhere('t.isChecked = :isChecked')
            ->setParameter('isChecked', $isChecked);

        return $qb
            ->getQuery()
            ->getResult();
    }

    public function getResultOfTest($testId, $start, $end)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb
            ->select('r')
            ->from(TestItemResults::class, 'r')
            ->where('r.testId = :testId')
            ->andWhere('r.cost BETWEEN :start AND :end')
            ->setParameters([
                'testId' => $testId,
                'start' => $start,
                'end' => $end
            ])
            ->getQuery()
            ->getResult();
    }

    public function getTestsByQuery($query, $category = null, $isChecked = 1)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('t')
            ->from(TestItem::class, 't')
            ->where('t.name LIKE :query')
            ->orWhere('t.description LIKE :query')
            ->orWhere('t.shortDescription LIKE :query')
            ->andWhere('t.isChecked = :isChecked')
            ->setParameter('isChecked', $isChecked)
            ->setParameter('query', '%'.$query.'%')
            ->orderBy('t.passedCount', 'DESC');

        if(!empty($category)) {
            $qb
                ->andWhere('t.categoryId = :category')
                ->setParameter('category', $category);
        }

        return $qb
            ->getQuery()
            ->getResult();
    }

    public function getTestItemById($id)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('t')
            ->from(TestItem::class, 't')
            ->where('t.id = :id')
            ->setParameter('id', $id);

        return $qb
                ->getQuery()
                ->getResult();
    }

    public function getAllNonCheckedTests()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb
                ->select('t')
                ->from(TestItem::class, 't')
                ->where('t.isChecked = 0')
                ->getQuery()
                ->getResult();
    }

    public function getPopularTests($isChecked = 1)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('t')
            ->from(TestItem::class, 't')
            ->orderBy('t.passedCount', 'DESC')
            ->andWhere('t.isChecked = :isChecked')
            ->andWhere('t.passedCount > 1000')
            ->setParameter('isChecked', $isChecked);

        return $qb
            ->getQuery()
            ->getResult();
    }

    public function getTestsBySubId($id, $isChecked = 1)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('t')
            ->from(TestItem::class, 't')
            ->orderBy('t.passedCount', 'DESC')
            ->andWhere('t.isChecked = :isChecked')
            ->andWhere('t.subCategoryId = :id')
            ->setParameter('id', $id)
            ->setParameter('isChecked', $isChecked);

        return $qb
            ->getQuery()
            ->getResult();
    }
}
