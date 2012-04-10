<?php

namespace HRO\SurveyBundle\Dao;

class DaoQuestion extends Dao {

    /**
     * Find Questions by a Survey
     * @param $id int The surveys' unique identifier
     * @return \HRO\SurveyBundle\Entity\Question[]
     */
	public function findBySurvey($id) {
		return $this->repo->findBySurvey($id);
	}

    public function findOneBySurvey($id) {
        return $this->repo->findOneBySurvey($id);
    }

	/**
	 * @see Dao
     * @param $doctrine \Symfony\Bundle\DoctrineBundle\Registry
	 */
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Question');
	}
}