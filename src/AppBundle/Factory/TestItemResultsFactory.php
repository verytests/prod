<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Tests\TestItemResults;

/**
 * Class TestItemResultsFactory
 * @package App\Factory
 */
class TestItemResultsFactory
{
    /**
     * @param int $testId
     * @param int $value
     * @param string $text
     * @param string $image
     * @return TestItemResults
     */
    public function create($testId, $value,  $text, $image = null)
    {
        $testItemResult = new TestItemResults();
        $testItemResult
            ->setTestId($testId)
            ->setCost($value)
            ->setText($text)
            ->setImageUrl($image);

         return $testItemResult;
    }
}
