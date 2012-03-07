<?php

namespace HRO\SurveyBundle\Dao;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;

class Dao extends ContainerAware {
	
	/**
	 * 
	 * Enter description here ...
	 * @var unknown_type
	 */
	protected $em;
	
	/**
	 * 
	 * Enter description here ...
	 * @var unknown_type
	 */
	protected $repo;
	
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
	 * 
	 * Enter description here ...
	 * @param unknown_type $container
	 */
	public function __construct($container)
	{
		$this->setContainer($container);
		$this->em = $this->container->get('doctrine')->getEntityManager();
		$this->repo = $this->em->getRepository('HROSurveyBundle:User');
	}
}