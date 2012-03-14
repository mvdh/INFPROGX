<?php

namespace HRO\SurveyBundle\Dao;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;

class Dao extends ContainerAware {

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
     * @return  \HRO\SurveyBundle\Entity\Answer |
     *          \HRO\SurveyBundle\Entity\Choice |
     *          \HRO\SurveyBundle\Entity\Question |
     *          \HRO\SurveyBundle\Entity\RespondentSurvey |
     *          \HRO\SurveyBundle\Entity\Survey |
     *          \HRO\SurveyBundle\Entity\User
     */
	public function find($id) {
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
	 * @param $container \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	public function __construct($container)
	{
		$this->setContainer($container);
		$this->em = $this->container->get('doctrine')->getEntityManager();
	}
}