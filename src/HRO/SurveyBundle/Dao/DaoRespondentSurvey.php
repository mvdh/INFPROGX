<?php

namespace HRO\SurveyBundle\Dao;

class DaoRespondentSurvey extends Dao {

    /**
     * Find all RespondentSurveys.
     * @return \HRO\SurveyBundle\Entity\RespondentSurvey[]
     */
    public function findAll() {
        return $this->repo->findAll();
    }

	/**
	 * Find RespondentSurveys by User.
	 * @param $id int The User's unique identifier
	 * @return \HRO\SurveyBundle\Entity\RespondentSurvey[]
	 */
	public function findByRespondent($id) {
		return $this->repo->findByRespondent($id);
	}

    /**
     * Find RespondentSurvey by combination of User and Survey
     * @param int $uId The User's unique identifier
     * @param int $sId The Survey's unique identifier
     * @return \HRO\SurveyBundle\Entity\RespondentSurvey
     */
    public function findByRespondentSurvey($uId, $sId){
        $qb = $this->em->createQueryBuilder();
        $qb ->add('select', 's')
            ->add('from', '\HRO\SurveyBundle\Entity\RespondentSurvey s')
            ->add('where', 's.respondent = ?1 and s.survey = ?2')
            ->setParameter(1, $uId)
            ->setParameter(2, $sId);
        $q = $qb->getQuery();
        $r = $q->getResult();
        if (count($r) > 0){
            return $r[0];
        }
        return null;
    }

    /**
     * Check RespondentSurvey exists.
     * @param int $uId The User's unique identifier
     * @param int $sId The Survey's unique identifier
     * @return bool
     */
    public function exists($uId, $sId) {
        if (!$this->findByRespondentSurvey($uId, $sId)){
            return false;
        }
        return true;
    }

    /**
     * @see Dao
     * @param $doctrine \Symfony\Bundle\DoctrineBundle\Registry
     */
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		$this->repo = $this->em->getRepository('HROSurveyBundle:RespondentSurvey');
	}

}