<?php

namespace HRO\SurveyBundle\Dao;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;

class Dao extends ContainerAware {

	/**
	 *
	 * Enter description here ...
	 * @var EntityManager
	 */
	protected $em;

	/**
	 * The repository to get the information from. 
	 * @var EntityRepository
	 */
	protected $repo;

	/**
	 * Retrieves an instance of the entity represented by the repository, based on a unique identier.
	 * @param integer $id
	 */
	public function get($id) {
		return $this->repo->find($id);
	}
	
	/**
	 *
	 * Enter description here ...
	 * @param unknown_type $object
	 */
	public function persist($object)
	{
		$this->em->persist($object);
	}

	/**
	 *
	 */
	public function flush()
	{
		$this->em->flush();
	}

	/**
	 * Constructor.
	 * Sets the EntityManager en the Repository for the type of 
	 * @param ContainerInterface $container
	 */
	public function __construct($container)
	{
		$this->setContainer($container);
		$this->em = $this->container->get('doctrine')->getEntityManager();
	}
}