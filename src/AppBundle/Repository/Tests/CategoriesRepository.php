<?php

namespace AppBundle\Repository\Tests;

use AppBundle\Entity\Others\Keyword;
use AppBundle\Entity\Others\ParsedLink;
use AppBundle\Entity\Tests\Categories;
use AppBundle\Entity\Tests\SubCategory;
use Doctrine\ORM\EntityRepository;

class CategoriesRepository extends EntityRepository
{
    public function getCategories()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb
            ->select('c')
            ->from(Categories::class, 'c')
            ->getQuery()
            ->getResult();
    }

    public function getCategory($id)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb
            ->select('c')
            ->from(Categories::class, 'c')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    public function getLinksForCategory($category, $amount)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb
            ->select('p')
            ->from(ParsedLink::class, 'p')
            ->where('p.categoryId = :category')
            ->andWhere('p.isAdded = 0')
            ->setParameter('category', $category)
            ->setMaxResults($amount)
            ->getQuery()
            ->getResult();
    }

    public function getKeywords($category = null)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('k.keyword')
            ->from(Keyword::class, 'k');

        if(!empty($category)) {
            $qb
                ->where('k.categoryId = :category')
                ->setParameter('category', $category);
        }

        return $qb
            ->getQuery()
            ->getArrayResult();
    }

    public function getSubCategories($category = null)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('s')
            ->from(SubCategory::class, 's');

        if(!empty($category)) {
            $qb
                ->where('s.categoryId = :category')
                ->setParameter('category', $category);
        }

        return $qb
            ->getQuery()
            ->getResult();
    }
}
