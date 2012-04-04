<?php

namespace HRO\SurveyBundle\Dao;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class Dao {

	/**
	 * @var EntityManager
	 */
	protected $em;

	/**
	 * @var EntityRepository
	 */
	protected $repo;

    /**
     * Retrieves an instance of the entity represented by the repository, based on a unique identifier.
     * @param $id int The id of the entity object to find
     * @return  \HRO\SurveyBundle\Entity\Answer | \HRO\SurveyBundle\Entity\Choice | \HRO\SurveyBundle\Entity\Question | \HRO\SurveyBundle\Entity\RespondentSurvey | \HRO\SurveyBundle\Entity\Survey | \HRO\SurveyBundle\Entity\User
     */
	public function findById($id) {
		return $this->repo->find($id);
	}
	
	/**
	 * @param $object mixed
	 */
	public function persist($object)
	{
		$this->em->persist($object);
	}

	public function flush()
	{
		$this->em->flush();
	}

    /**
     * Constructor.
     * @param $doctrine \Symfony\Bundle\DoctrineBundle\Registry
     */
	public function __construct($doctrine)
	{
		$this->em = $doctrine->getEntityManager();
	}
}