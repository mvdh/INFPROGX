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
     * @param $container \Symfony\Component\DependencyInjection\ContainerInterface
     */
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:RespondentSurvey');
	}
}