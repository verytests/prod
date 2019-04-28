<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Tests\TestItemQuestions;

/**
 * Class TestItemQuestionsFactory
 * @package App\Factory
 */
class TestItemQuestionsFactory
{
    /**
     * Creates a test question entity
     *
     * @param $testId
     * @param $question
     * @return TestItemQuestions
     */
    public function create($testId,$question)
    {
        $testItemQuestion = new TestItemQuestions();

        $testItemQuestion
            ->setTestId($testId)
            ->setDescription($question);

        return $testItemQuestion;
    }
}
