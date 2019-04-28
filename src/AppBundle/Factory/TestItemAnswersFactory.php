<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Tests\TestItemAnswers;

/**
 * Class TestItemAnswersFactory
 * @package App\Factory
 */
class TestItemAnswersFactory
{
    public function create($questionId, $value, $text)
    {
        $testItemAnswer = new TestItemAnswers();

        $testItemAnswer
            ->setQuestionId($questionId)
            ->setValue($value)
            ->setText($text);

        return $testItemAnswer;
    }
}
