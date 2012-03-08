<?php

namespace HRO\SurveyBundle\Dao;

class DaoSurvey extends Dao {
	
	/**
	 * Finds the surveys of an owner ((a user), based on the owners unique identifier.
	 * @param Integer $id The unique identifier for an owner
	 * @return An array with one or more survey if they exists. Otherwise it returns Null 
	 */
	public function findByOwner($id) {
		return $this->repo->findByOwner($id);
	}
	
	/**
	 * Finds the survey with the given title. Titles are unique, so there will be only one.
	 * @param String $title The given title
	 * @return A Survey if a survey was found, otherwise Null
	 */
	public function findOneByTitle($title) {
		return $this->repo->findOneByTitle($title);
	}
	
	/**
	 * @see Dao
	 */
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Survey');
	}
}