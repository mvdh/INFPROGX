<?php

namespace HRO\SurveyBundle\Dao;

class DaoRespondentSurvey extends Dao {
	
	/**
	 * Finds the combinations respondent - survey by a user's unique identifier.
	 * @param Integer $id The user's unique identifier
	 * @return An array with one or more repondent - survey combinations if they exists. Otherwise Null 
	 */
	public function findByRespondent($id) {
		return $this->repo->findByRespondent($id);
	}
	
	/**
	 * @see Dao
	 */
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:RespondentSurvey');
	}
}