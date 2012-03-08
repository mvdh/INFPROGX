<?php

namespace HRO\SurveyBundle\Dao;

class DaoQuestion extends Dao {
	
	/**
	 * Finds questions belonging to a survey, based on the survey's unique identifier.
	 * @param Integer $id The survey's unique identifier
	 * @return An array with question if they exist, or Null
	 */
	public function findBySurvey($id) {
		return $this->repo->findBySurvey($id);
	}
	
	/**
	 * @see Dao
	 */
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Question');
	}
}