<?php


namespace AppBundle\Entity\Tests;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sub_categories")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tests\CategoriesRepository")
 */
class SubCategory
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
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    public function getId()
    {
        return $this->id;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($name)
    {
        $this->category = $name;

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
}
