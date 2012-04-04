<?php

namespace HRO\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HRO\SurveyBundle\Entity\Answer
 *
 * @ORM\Table(name="answer")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="answer_type", type="string")
 * @ORM\DiscriminatorMap({"answer" = "Answer", "scale_answer" = "ScaleAnswer", "multiple_choice_answer" = "MultipleChoiceAnswer"})
 */
class Answer
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var text $text
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text = '';

    /**
     * @var integer $question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn(name="question", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $question;

    /**
     * @var integer $respondentSurvey
     *
     * @ORM\ManyToOne(targetEntity="RespondentSurvey")
     * @ORM\JoinColumn(name="respondent_survey", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $respondentSurvey;


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
     * Set text
     *
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return text 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set question
     *
     * @param integer $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * Get question
     *
     * @return integer 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set respondentSurvey
     *
     * @param integer $respondentSurvey
     */
    public function setRespondentSurvey($respondentSurvey)
    {
        $this->respondentSurvey = $respondentSurvey;
    }

    /**
     * Get respondentSurvey
     *
     * @return integer 
     */
    public function getRespondentSurvey()
    {
        return $this->respondentSurvey;
    }
}