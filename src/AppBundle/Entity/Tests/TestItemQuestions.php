<?php

namespace AppBundle\Entity\Tests;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="test_item_questions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tests\TestItemRepository")
 */
class TestItemQuestions
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
     * @ORM\Column(type="text")
     */
    private $text;


    public function getId()
    {
        return $this->id;
    }

    public function getTestId()
    {
        return $this->testId;
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

    public function setDescription($text)
    {
        $this->text = $text;

        return $this;
    }
}
