<?php

namespace AppBundle\Entity\Tests;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="test_item_results")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tests\TestItemRepository")
 */
class TestItemResults
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
     * @ORM\Column(type="integer")
     */
    private $cost;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $imageUrl;

    public function getId()
    {
        return $this->id;
    }

    public function getTestId()
    {
        return $this->testId;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setTestId($id)
    {
        $this->testId = $id;

        return $this;
    }

    public function setCost($value)
    {
        $this->cost = $value;

        return $this;
    }

    public function setText($value)
    {
        $this->text = $value;

        return $this;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function setImageUrl($url)
    {
        $this->imageUrl = $url;

        return $this;
    }
}
