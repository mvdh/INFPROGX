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
     * @param $container \Symfony\Component\DependencyInjection\ContainerInterface
     */
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Choice');
	}
}