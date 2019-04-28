<?php

namespace AppBundle\Entity\Tests;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="test_item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tests\TestItemRepository")
 */
class TestItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\Column(type="integer")
     */
    private $categoryId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mainImage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="text")
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="decimal")
     */
    private $passedCount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isChecked;

    /**
     * @ORM\Column(type="string", unique=true, length=180)
     */
    private $urlName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $subCategoryId;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setDescription($desc)
    {
        $this->description = $desc;

        return $this;
    }

    public function setCategoryId($category)
    {
        $this->categoryId = $category;

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

    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    public function setShortDescription($desc)
    {
        $this->shortDescription = $desc;

        return $this;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($date)
    {
        $this->creationDate = $date;

        return $this;
    }

    public function getPassedCount()
    {
        return $this->passedCount;
    }

    public function setPassedCount($count)
    {
        $this->passedCount = $count;

        return $this;
    }

    public function getIsChecked()
    {
        return $this->isChecked;
    }

    public function setIsChecked($is)
    {
        $this->isChecked = $is;

        return $this;
    }

    public function getMainImage()
    {
        return $this->mainImage;
    }

    public function setMainImage($image)
    {
        $this->mainImage = $image;

        return $this;
    }

    public function getUrlName()
    {
        return $this->urlName;
    }

    public function setUrlName($name)
    {
        $this->urlName = $name;

        return $this;
    }

    public function getSubCategoryId()
    {
        return $this->subCategoryId;
    }

    public function setSubCategoryId($id)
    {
        $this->subCategoryId = $id;

        return $this;
    }
}
