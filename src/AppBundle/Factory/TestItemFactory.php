<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Tests\TestItem;

/**
 * Class TestItemFactory
 * @package App\Factory
 */
class TestItemFactory
{
    /**
     * Creates a test item entity
     *
     * @param string $name
     * @param string $desc
     * @param string|null $image
     * @param int $category
     * @param boolean $isChecked
     * @param string $mainImage
     * @param $subCategory
     * @return TestItem
     * @throws \Exception
     */
    public function create($name, $desc, $image = null, $category = 1, $subCategory = 1, $isChecked = false,$mainImage = null)
    {
        $testItem = new TestItem();
        $short = $desc;

        if(strlen($desc) > 90) {
            $short = substr($desc, 0, 90);
            $short .= '...';
        }

        $shortDesc = $short;

        $tmp = explode('?',$name);
        $urlName = preg_replace("/[^a-zA-Z]/", "-", $tmp[0]);

        $passedCount = rand(31999, 94985);

        $testItem
            ->setName($name)
            ->setDescription($desc)
            ->setCategoryId($category)
            ->setImageUrl($image)
            ->setShortDescription($shortDesc)
            ->setCreationDate(new \DateTime())
            ->setIsChecked($isChecked)
            ->setMainImage($mainImage)
            ->setUrlName($urlName)
            ->setPassedCount($passedCount)
            ->setSubCategoryId($subCategory);

        return $testItem;
    }
}
