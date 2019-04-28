<?php

namespace AppBundle\Entity\Others;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="category_keywords")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tests\CategoriesRepository")
 */
class Keyword
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
    private $categoryId;

    /**
     * @ORM\Column(type="string")
     */
    private $keyword;

    public function getId()
    {
        return $this->id;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId($id)
    {
        $this->categoryId = $id;

        return $this;
    }

    public function getKeyword()
    {
        return $this->keyword;
    }

    public function setKeyword($word)
    {
        $this->keyword = $word;

        return $this;
    }
}
