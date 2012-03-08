<?php

namespace HRO\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HRO\SurveyBundle\Entity\Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="question_type", type="string")
 * @ORM\DiscriminatorMap({"question" = "Question", "scale_question" = "ScaleQuestion", "multiple_choice_question" = "MultipleChoiceQuestion"})
 */
class Question
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
     * @var text $questionText
     *
     * @ORM\Column(name="question_text", type="text", nullable=false)
     * @Assert\NotBlank()
     */
    private $questionText;

    /**
     * @var integer $survey
     *
     * @ORM\ManyToOne(targetEntity="Survey")
     * @ORM\JoinColumn(name="survey", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $survey;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set questionText
     *
     * @param text $questionText
     */
    public function setQuestionText($questionText)
    {
        $this->questionText = $questionText;
    }

    /**
     * Get questionText
     *
     * @return text 
     */
    public function getQuestionText()
    {
        return $this->questionText;
    }

    /**
     * Set survey
     *
     * @param integer $survey
     */
    public function setSurvey($survey)
    {
        $this->survey = $survey;
    }

    /**
     * Get survey
     *
     * @return integer 
     */
    public function getSurvey()
    {
        return $this->survey;
    }
}