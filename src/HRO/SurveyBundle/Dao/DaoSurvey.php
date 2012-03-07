<?php

namespace HRO\SurveyBundle\Dao;

use Doctrine\ORM\EntityManager;
use HRO\SurveyBundle\Entity\Survey;

class DaoSurvey extends Dao {
	
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Survey');
	}
}