<?php

namespace HRO\SurveyBundle\Dao;

class DaoAnswer extends Dao {

	/**
	 * Find Answers by a Question.
	 * @param int $id The Question's unique identifier
	 * @return \HRO\SurveyBundle\Entity\Answer[]
	 */
	public function findByQuestion($id){
		return $this->repo->findByQuestion($id);
	}
	
	/**
	 * Find Answers by a RespondentSurvey.
	 * @param int $id The RespondentSurveys' unique identifier
	 * @return \HRO\SurveyBundle\Entity\Answer[]
	 */
	public function findByRespondentSurvey($id) {
		return $this->repo->findByRespondentSurvey($id);
	}


    public function findByRespSurveyQuestion($rsId, $qId) {
        $qb = $this->em->createQueryBuilder();
        $qb ->add('select', 'a')
            ->add('from', '\HRO\SurveyBundle\Entity\Answer a')
            ->add('where', 'a.respondentSurvey = ?1 and a.question = ?2')
            ->setParameter(1, $rsId)
            ->setParameter(2, $qId);
        $q = $qb->getQuery();
        $r = $q->getResult();
        if (count($r) > 0){
            return $r[0];
        }
        return null;
    }

    /**
     * Remove RespondentSurvey's answers
     * @param $respondentSurveyId The RespondentSurvey's unique identifier
     */
    public function removeAnswers($respondentSurveyId) {
        $qb = $this->em->createQueryBuilder();
        $qb ->delete('a')
            ->add('from', '\HRO\SurveyBundle\Entity\Answer a')
            ->add('where', 'a.respondentSurvey = ?1')
            ->setParameter(1, $respondentSurveyId);
        $q = $qb->getQuery();
        $q->execute();
    }

    /**
     * @see Dao
     * @param $doctrine \Symfony\Bundle\DoctrineBundle\Registry
     */
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		$this->repo = $this->em->getRepository('HROSurveyBundle:Answer');
	}	
}
