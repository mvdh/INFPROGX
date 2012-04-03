<?php

namespace HRO\SurveyBundle\Controller;

use HRO\SurveyBundle\Dao\DaoSurvey;
use HRO\SurveyBundle\Dao\DaoQuestion;
use HRO\SurveyBundle\Dao\DaoRespondentSurvey;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class QuestionController extends Controller
{
    
    public function showAction($id)
    {
        $daoQuestion = new DaoQuestion($this->container);
        $question = $daoQuestion->findById($id);
        if($question) {
            $survey = $question->getSurvey();
            $daoRespondentSurvey = new DaoRespondentSurvey($this->container);
            $rs = $daoRespondentSurvey->findById($survey->getId());
            if(!$rs) {
                return;
            }

        }
    }

}
