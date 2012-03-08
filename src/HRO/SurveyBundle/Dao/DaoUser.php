<?php

namespace HRO\SurveyBundle\Dao;

class DaoUser extends Dao {
	
	/**
	 * Finds a user by it's emailaddress.
	 * @param String $emailAddress
	 * @return A user if found, otherwise Null
	 */
	public function findOneByEmailAddress($emailAddress) {
		return $this->repo->findOneByEmailAddress($emailAddress);
	}
	
	/**
	 * Finds a user by it's username.
	 * @param String $username
	 * @return A user if founc, otherwise Null
	 */
	public function findOneByUsername($username) {
		return $this->repo->findOneByUsername($username);
	}
	
	/**
	 * @see Dao
	 */
	public function __construct($container) {
		parent::__construct($container);
		$this->repo = $this->em->getRepository('HROSurveyBundle:User');
	}
}