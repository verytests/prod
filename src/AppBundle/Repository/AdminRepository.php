<?php
namespace AppBundle\Repository;

use AppBundle\Entity\Admin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Admin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Admin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Admin[]    findAll()
 * @method Admin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminRepository extends ServiceEntityRepository
{
    public function getAdmins()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb
            ->select('a.id','a.login','a.password','a.roles')
            ->from(Admin::class, 'a')
            ->getQuery()
            ->getResult();
    }

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Admin::class);
    }
}
