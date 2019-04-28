<?php

namespace AppBundle\Entity\Tests;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="test_item_answers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tests\TestItemRepository")
 */
class TestItemAnswers
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
    private $questionId;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    public function getId()
    {
        return $this->id;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getQuestionId()
    {
        return $this->questionId;
    }

    public function setQuestionId($value)
    {
        $this->questionId = $value;

        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function setText($value)
    {
        $this->text = $value;

        return $this;
    }
}
