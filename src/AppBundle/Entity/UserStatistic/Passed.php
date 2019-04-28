<?php

namespace AppBundle\Entity\UserStatistic;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="passed")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserStatistic\UserStatisticRepository")
 */
class Passed
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
    private $testId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $passedTime;

    public function getId()
    {
        return $this->id;
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

    public function getPassedTime()
    {
        return $this->passedTime;
    }

    public function setPassedTime($time)
    {
        $this->passedTime = $time;

        return $this;
    }
}
