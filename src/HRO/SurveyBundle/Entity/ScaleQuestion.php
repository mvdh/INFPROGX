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
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $range
     *
     * @ORM\Column(name="`range`", type="integer", nullable=false)
     * @Assert\Type(type="integer")
     */
    private $range;


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