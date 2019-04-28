<?php

namespace AppBundle\Services;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    protected $connection;

    public function __construct(EntityManagerInterface $em)
    {
        $this->connection = $em;
    }

    public function save($user)
    {
        $this->connection->persist($user);
        $this->connection->flush();
    }

    public function getUserByEmail($email)
    {
        return $this->connection->getRepository(User::class)->findOneBy(['email' => $email]);
    }

    public function getUserByLogin($login)
    {
        return $this->connection->getRepository(User::class)->findOneBy(['login' => $login]);
    }

    public function getUserByToken($token)
    {
        return $this->connection->getRepository(User::class)->findOneBy(['token' => $token]);
    }
}
