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
	
	/**
	 * @see Dao
     * @param $container \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Question');
	}
}