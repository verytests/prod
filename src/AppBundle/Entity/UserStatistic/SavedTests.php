<?php

namespace AppBundle\Entity\UserStatistic;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;


/**
 * @ORM\Table(name="saved_tests")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserStatistic\UserStatisticRepository")
 */
class SavedTests
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
     * @ManyToOne(targetEntity="App\Entity\Tests\TestItem")
     * @JoinColumn(name="role", referencedColumnName="id")
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
