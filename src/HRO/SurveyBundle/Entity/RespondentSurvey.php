<?php

namespace HRO\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HRO\SurveyBundle\Entity\RespondentSurvey
 *
 * @ORM\Table(name="respondent_survey", uniqueConstraints={@ORM\UniqueConstraint(name="respondent_survey_constraint", columns={"respondent", "survey"})})
 * @ORM\Entity
 */
class RespondentSurvey
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
     * @var integer $respondent
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="respondent", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $respondent;

    /**
     * @var integer $survey
     *
     * @ORM\ManyToOne(targetEntity="Survey")
     * @ORM\JoinColumn(name="survey", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $survey;

    /**
     * @var boolean $completed
     *
     * @ORM\Column(name="completed", type="boolean")
     * @Assert\Type(type="bool")
     */
    private $completed = false;


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
     * Set respondent
     *
     * @param integer $respondent
     */
    public function setRespondent($respondent)
    {
        $this->respondent = $respondent;
    }

    /**
     * Get respondent
     *
     * @return integer 
     */
    public function getRespondent()
    {
        return $this->respondent;
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

    /**
     * Set completed
     *
     * @param boolean $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }

    /**
     * Get completed
     *
     * @return boolean 
     */
    public function getCompleted()
    {
        return $this->completed;
    }
}