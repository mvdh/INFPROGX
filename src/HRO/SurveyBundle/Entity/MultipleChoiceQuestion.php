<?php

namespace HRO\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HRO\SurveyBundle\Entity\MultipleChoiceQuestion
 *
 * @ORM\Table(name="multiple_choice_question")
 * @ORM\Entity
 */
class MultipleChoiceQuestion extends Question
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}