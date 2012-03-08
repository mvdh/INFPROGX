<?php

namespace HRO\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HRO\SurveyBundle\Entity\Choice
 *
 * @ORM\Table(name="choice")
 * @ORM\Entity
 */
class Choice
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
     * @var string $choiceText
     *
     * @ORM\Column(name="choice_text", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $choiceText;

    /**
     * @var integer $question
     *
     * @ORM\ManyToOne(targetEntity="MultipleChoiceQuestion")
     * @ORM\JoinColumn(name="question", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */
    private $question;


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
     * Set choiceText
     *
     * @param string $choiceText
     */
    public function setChoiceText($choiceText)
    {
        $this->choiceText = $choiceText;
    }

    /**
     * Get choiceText
     *
     * @return string 
     */
    public function getChoiceText()
    {
        return $this->choiceText;
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
}