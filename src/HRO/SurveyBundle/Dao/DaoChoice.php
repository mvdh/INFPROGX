<?php

namespace HRO\SurveyBundle\Dao;

class DaoChoice extends Dao {
	
	/**
	 * Find Choices by a MultipleChoiceQuestion.
	 * @param $id int The MultipleChoiceQuestion's unique identifier
	 * @return \HRO\SurveyBundle\Entity\Choice[]
	 */
	public function findByQuestion($id) {
		return $this->repo->findByQuestion($id);
	}

    /**
     * @see Dao
     * @param $doctrine \Symfony\Bundle\DoctrineBundle\Registry
     */
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Choice');
	}
}