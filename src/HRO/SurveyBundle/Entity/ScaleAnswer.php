<?php

namespace HRO\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HRO\SurveyBundle\Entity\ScaleAnswer
 *
 * @ORM\Table(name="scale_answer")
 * @ORM\Entity
 */
class ScaleAnswer extends Answer
{

    /**
     * @var integer $value
     *
     * @ORM\Column(name="value", type="integer", nullable=false)
     * @Assert\Type(type="integer")
     */
    private $value;

    /**
     * Set value
     *
     * @param integer $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }
}