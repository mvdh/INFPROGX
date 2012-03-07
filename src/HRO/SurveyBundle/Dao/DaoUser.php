<?php

namespace HRO\SurveyBundle\Dao;

use HRO\SurveyBundle\Entity\User;

class DaoUser extends Dao {
	
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:User');
	}
}