<?php
namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function getAdmins()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb
            ->select('u.id','u.login','u.password','u.roles')
            ->from(User::class, 'u')
            ->getQuery()
            ->getResult();
    }

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }
}
