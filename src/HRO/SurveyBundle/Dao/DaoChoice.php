<?php

namespace HRO\SurveyBundle\Dao;

class DaoChoice extends Dao {
	
	/**
	 * Finds Choices belonging to a MultipleChoiceQuestion.
	 * @param Integer $id The MultilpleChoiceQuestion's unique identifier
	 * @return An array with Choices if they exist, otherwise Null
	 */
	public function findByQuestion($id) {
		return $this->repo->findByQuestion($id);
	}
	
	/**
	 * @see Dao
	 */
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Choice');
	}
}