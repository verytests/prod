<?php

namespace AppBundle\Entity\Others;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="parsed_links")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tests\CategoriesRepository")
 */
class ParsedLink
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $link;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdded;

    /**
     * @ORM\Column(type="integer")
     */
    private $categoryId;

    /**
     * @ORM\Column(type="string")
     */
    private $parsedCategoryName;

    public function getId()
    {
        return $this->id;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    public function getIsAdded()
    {
        return $this->isAdded;
    }

    public function setIsAdded($is)
    {
        $this->isAdded = $is;

        return $this;
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

    public function getParsedCategoryName()
    {
        return $this->parsedCategoryName;
    }

    public function setParsedCategoryName($name)
    {
        $this->parsedCategoryName = $name;

        return $this;
    }
}
