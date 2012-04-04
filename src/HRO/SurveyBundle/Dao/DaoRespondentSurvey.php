<?php

namespace HRO\SurveyBundle\Dao;

class DaoRespondentSurvey extends Dao {
	
	/**
	 * Find RespondentSurveys by User.
	 * @param $id int The User's unique identifier
	 * @return \HRO\SurveyBundle\Entity\RespondentSurvey[]
	 */
	public function findByRespondent($id) {
		return $this->repo->findByRespondent($id);
	}

    /**
     * @see Dao
     * @param $doctrine \Symfony\Bundle\DoctrineBundle\Registry
     */
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		$this->repo = $this->em->getRepository('HROSurveyBundle:RespondentSurvey');
	}
}