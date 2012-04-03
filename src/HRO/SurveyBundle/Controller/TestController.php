<?php

namespace HRO\SurveyBundle\Controller;

use HRO\SurveyBundle\Dao\DaoSurvey;
use HRO\SurveyBundle\Dao\DaoUser;
use HRO\SurveyBundle\Dao\DaoRespondentSurvey;
use HRO\SurveyBundle\Dao\DaoQuestion;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class TestController extends Controller
{
    
    public function indexAction()
    {
    	$daoSurvey = new DaoSurvey($this->container);
    	$daoUser = new DaoUser($this->container);
    	$daoRespondentSurvey = new DaoRespondentSurvey($this->container);
    	$daoQuestion = new DaoQuestion($this->container);

     	$owner = $daoUser->find(10);
 		$ownerSurveys = $daoSurvey->findByOwner($owner->getId());

 		if($ownerSurveys) {
 			foreach($ownerSurveys as $survey) {
 				print $survey->getTitle() . '<br />';
 			}
 		}

 		$title = 'Een eerste enquete';
 		$survey = $daoSurvey->findOneByTitle($title);
		
 		if($survey) {
 			print $survey->getTitle() . '<br />';
 		}

     	$user = $daoUser->findOneByEmailAddress('maartenvandenhoek@gmail.com');
     	print $user->getUsername() . '<br />';
    	
     	$user = $daoUser->findOneByUsername('andra');
    		print $user->getEmailAddress() . '<br />';

     	$respSurvey = $daoRespondentSurvey->findByRespondent(4);
     	foreach($respSurvey as $rS) {
     		if ($rS->getCompleted()){
     			print 'true';
     		}
     		else {
     			print 'false';
     		}
     	}
		
     	$questions = $daoQuestion->findBySurvey(2);
     	foreach ($questions as $question) {
     		$parts = explode('\\', get_class($question));
     		if(end($parts) == 'ScaleQuestion') {
     			print $question->getRange();
     		}
     		print $question->getQuestionText();
     	}
    	
        return $this->render('HROSurveyBundle:Default:testindex.html.twig', array());
    }
}
