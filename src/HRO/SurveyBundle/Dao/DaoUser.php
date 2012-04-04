<?php

namespace HRO\SurveyBundle\Dao;

class DaoUser extends Dao {
	
	/**
	 * Find a User by email address.
	 * @param $emailAddress String
	 * @return \HRO\SurveyBundle\Entity\User
	 */
	public function findOneByEmailAddress($emailAddress) {
		return $this->repo->findOneByEmailAddress($emailAddress);
	}
	
	/**
	 * Find a user by username.
	 * @param $username String
	 * @return \HRO\SurveyBundle\Entity\User
	 */
	public function findOneByUsername($username) {
		return $this->repo->findOneByUsername($username);
	}
	
	/**
	 * @see Dao
     * @param $doctrine \Symfony\Bundle\DoctrineBundle\Registry
	 */
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		$this->repo = $this->em->getRepository('HROSurveyBundle:User');
	}
}