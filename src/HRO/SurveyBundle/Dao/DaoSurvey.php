<?php

namespace HRO\SurveyBundle\Dao;

class DaoSurvey extends Dao {
	
	/**
	 * Find Surveys by Owner (a User).
	 * @param Integer $id The User's unique identifier
	 * @return \HRO\SurveyBundle\Entity\Survey[]
	 */
	public function findByOwner($id) {
		return $this->repo->findByOwner($id);
	}

	/**
	 * Find a Survey by title.
	 * @param $title String
	 * @return \HRO\SurveyBundle\Entity\Survey
	 */
	public function findOneByTitle($title) {
		return $this->repo->findOneByTitle($title);
	}

    /**
     * @see Dao
     * @param $container \Symfony\Component\DependencyInjection\ContainerInterface
     */
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Survey');
	}
}