<?php

namespace HRO\SurveyBundle\Dao;

class DaoAnswer extends Dao {

	/**
	 * Find Answers by a Question.
	 * @param $id int The Question's unique identifier
	 * @return \HRO\SurveyBundle\Entity\Answer[]
	 */
	public function findByQuestion($id){
		return $this->repo->findByQuestion($id);
	}
	
	/**
	 * Find Answers by a RespondentSurvey.
	 * @param $id int The RespondentSurveys' unique identifier
	 * @return \HRO\SurveyBundle\Entity\Answer[]
	 */
	public function findByRespondentSurvey($id) {
		return $this->repo->findByRespondentSurvey($id);
	}

    /**
     * @see Dao
     * @param $container \Symfony\Component\DependencyInjection\ContainerInterface
     */
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Answer');
	}	
}
