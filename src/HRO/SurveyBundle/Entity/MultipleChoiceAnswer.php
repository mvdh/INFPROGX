<?php

namespace HRO\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HRO\SurveyBundle\Entity\MultipleChoiceAnswer
 *
 * @ORM\Table(name="multiple_choice_answer")
 * @ORM\Entity
 */
class MultipleChoiceAnswer extends Answer
{

    /**
     * @var integer $choice
     *
     * @ORM\ManyToOne(targetEntity="Choice")
     * @ORM\JoinColumn(name="choice", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $choice;

    /**
     * Set choice
     *
     * @param integer $choice
     */
    public function setChoice($choice)
    {
        $this->choice = $choice;
    }

    /**
     * Get choice
     *
     * @return integer 
     */
    public function getChoice()
    {
        return $this->choice;
    }
}