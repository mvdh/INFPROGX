<?php

namespace HRO\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HRO\SurveyBundle\Entity\ScaleQuestion
 *
 * @ORM\Table(name="scale_question")
 * @ORM\Entity
 */
class ScaleQuestion extends Question
{

    /**
     * @var integer $range
     *
     * @ORM\Column(name="`range`", type="integer", nullable=false)
     * @Assert\Type(type="integer")
     */
    private $range;

    /**
     * @var text $textLow
     *
     * @ORM\Column(name="text_low", type="text", nullable=false)
     * @Assert\NotBlank()
     */
    private $textLow;

    /**
     * @var text $highLow
     *
     * @ORM\Column(name="text_high", type="text", nullable=false)
     * @Assert\NotBlank()
     */
    private $textHigh;

    /**
     * Set range
     *
     * @param integer $range
     */
    public function setRange($range)
    {
        $this->range = $range;
    }

    /**
     * Get range
     *
     * @return integer 
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * Set textLow
     *
     * @param text $textLow
     */
    public function setTextLow($textLow)
    {
        $this->textLow = $textLow;
    }

    /**
     * Get textLow
     *
     * @return text 
     */
    public function getTextLow()
    {
        return $this->textLow;
    }

    /**
     * Set textHigh
     *
     * @param text $textHigh
     */
    public function setTextHigh($textHigh)
    {
        $this->textHigh = $textHigh;
    }

    /**
     * Get textHigh
     *
     * @return text 
     */
    public function getTextHigh()
    {
        return $this->textHigh;
    }

}