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
     * Delete the Answers from
     * @param \HRO\SurveyBundle\Entity\RespondentSurvey $respondentSurvey
     * @param \HRO\SurveyBundle\Entity\Question $question
     */
    public function removeAnswers($respondentSurvey, $question) {
        if($respondentSurvey->getCompleted()) {
            return;
        }
        $qb = $this->em->createQueryBuilder();
        $qb ->add('delete', 's')
            ->add('from', '\HRO\SurveyBundle\Entity\Answer a')
            ->add('where', 's.question = ?1 and s.respondent_survey = ?2')
            ->setParameter(1, $question->getId())
            ->setParameter(2, $respondentSurvey->getId());

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
