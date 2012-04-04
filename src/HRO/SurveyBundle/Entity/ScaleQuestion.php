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
}