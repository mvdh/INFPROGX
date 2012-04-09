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
