<?php

namespace HRO\SurveyBundle\Dao;

class DaoSurvey extends Dao {
	
	/**
	 * Find Surveys by Owner (a User).
	 * @param int $id The User's unique identifier
	 * @return \HRO\SurveyBundle\Entity\Survey[]
	 */
	public function findByOwner($id) {
		return $this->repo->findByOwner($id);
	}

	/**
	 * Find a Survey by title.
	 * @param string $title The title.
	 * @return \HRO\SurveyBundle\Entity\Survey
	 */
	public function findOneByTitle($title) {
		return $this->repo->findOneByTitle($title);
	}

    /**
     * Find all Surveys.
     * @return \HRO\SurveyBundle\Entity\Survey[]
     */
    public function findAll() {
        return $this->repo->findAll();
    }

    /**
     * Find Surveys.
     *
     * @param int $firstResult The first result to return.
     * @param int $maxResults The maximum number of results.
     * @return \HRO\SurveyBundle\Entity\Survey[]
     */
    public function find($firstResult, $maxResults) {
        $qb = $this->em->createQueryBuilder();
        $qb ->add('select', 's')
            ->add('from', '\HRO\SurveyBundle\Entity\Survey s');
        $qb->setFirstResult($firstResult);
        $qb->setMaxResults($maxResults);
        return $qb->getQuery()->getResult();
    }

    /**
     * @see Dao
     * @param $doctrine \Symfony\Bundle\DoctrineBundle\Registry
     */
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Survey');
	}
}