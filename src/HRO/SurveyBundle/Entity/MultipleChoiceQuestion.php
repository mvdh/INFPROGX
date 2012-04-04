<?php

namespace HRO\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HRO\SurveyBundle\Entity\MultipleChoiceQuestion
 *
 * @ORM\Table(name="multiple_choice_question")
 * @ORM\Entity
 */
class MultipleChoiceQuestion extends Question
{
}