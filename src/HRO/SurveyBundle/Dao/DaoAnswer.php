<?php

namespace HRO\SurveyBundle\Dao;

class DaoAnswer extends Dao {

	/**
	 * Finds answer on a question.
	 * @param Integer $id The Question's unique identifier
	 * @return An array with Answers if they exist, otherwise Null
	 */
	public function findByQuestion($id){
		return $this->repo->findByQuestion($id);
	}
	
	/**
	 * Find answers belonging to a RespondentSurvey.
	 * @param Integer $id The RespondentSurvey's unique identifier
	 * @return An array with Answers if they exist, otherwise Null
	 */
	public function findByRespondentSurvey($id) {
		return $this->repo->findByRespondentSurvey($id);
	}
	
   /**
	* @see Dao
	*/
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Answer');
	}	
}
