<?php

namespace AppBundle\Entity\UserStatistic;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="recent_tests")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserStatistic\UserStatisticRepository")
 */
class RecentTests
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(type="integer")
     */
    private $testId;

    public function getRecentTestId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($id)
    {
        $this->userId = $id;

        return $this;
    }

    public function getTestId()
    {
        return $this->testId;
    }

    public function setTestId($id)
    {
        $this->testId = $id;

        return $this;
    }
}
