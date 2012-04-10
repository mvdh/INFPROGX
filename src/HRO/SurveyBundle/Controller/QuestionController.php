<?php

namespace HRO\SurveyBundle\Controller;

use \HRO\SurveyBundle\Entity\Choice;
use \HRO\SurveyBundle\Entity\MultipleChoiceAnswer;
use \HRO\SurveyBundle\Entity\ScaleAnswer;
use \Symfony\Component\HttpFoundation\Request;
use \HRO\SurveyBundle\Entity\Answer;
use \HRO\SurveyBundle\Entity\Question;
use \HRO\SurveyBundle\Entity\ScaleQuestion;
use \HRO\SurveyBundle\Entity\MultipleChoiceQuestion;
use HRO\SurveyBundle\Dao\DaoSurvey;
use HRO\SurveyBundle\Dao\DaoQuestion;
use HRO\SurveyBundle\Dao\DaoRespondentSurvey;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class QuestionController extends Controller
{
    
    public function showAction($id)
    {
        $daoAnswer = $this->get('dao_answer');
        $daoChoice = $this->get('dao_choice');
        $daoQuestion = $this->get('dao_question');
        $daoRespondentSurvey = $this->get('dao_respondent_survey');
        $user = $this->get('security.context')->getToken()->getUser();

        $question = $daoQuestion->findById($id);
        if($question) {
            $survey = $question->getSurvey();
            $respondentSurvey = $daoRespondentSurvey->findByRespondentSurvey($user->getId(), $survey->getId());
            if($respondentSurvey) {
                $answer = $daoAnswer->findByRespSurveyQuestion($respondentSurvey->getId(), $question->getId());
                $surveyQuestions = $daoQuestion->findBySurvey($survey->getId());
                $t = array();
                foreach($surveyQuestions as $i => $surveyQuestion) {
                    if ($surveyQuestion->getId() == $id) {
                        if($i > 0) {
                            $t['prev'] = $surveyQuestions[$i-1];
                        }
                        if($i < count($surveyQuestions)-1) {
                            $t['next'] = $surveyQuestions[$i+1];
                        }
                    }
                }
                $t['question'] = $question;
                $t['survey'] = $survey;
                if($question instanceof MultipleChoiceQuestion){
                    $type = 'm';
                    $choices = $daoChoice->findByQuestion($question->getId());
                    $t['choices'] = $choices;
                } else if ($question instanceof ScaleQuestion){
                    $type = 's';
                } else if ($question instanceof Question) {
                    $type = 'q';
                }
                $t['answer'] = $answer;
                $t['type'] = $type;

                return $this->render('HROSurveyBundle:Default:question_show.html.twig', $t);
            }
            else {
                //niet gemachtigd om de vraag te zien.
            }
        }
        else {
            //vraag bestaat niet
        }
    }

    public function saveAnswerAction(Request $request, $id) {
        $daoAnswer = $this->get('dao_answer');
        $daoChoice = $this->get('dao_choice');
        $daoQuestion = $this->get('dao_question');
        $daoRespSurvey = $this->get('dao_respondent_survey');
        $user = $this->get('security.context')->getToken()->getUser();

        $question = $daoQuestion->findById($id);
        if($question) {
            $survey = $question->getSurvey();
            $respSurvey = $daoRespSurvey->findByRespondentSurvey($user->getId(), $survey->getId());
            if($respSurvey) {
                $answer = $daoAnswer->findByRespSurveyQuestion($respSurvey->getId(), $question->getId());
                if($question instanceof MultipleChoiceQuestion){
                    if(!$answer){
                        $answer = new MultipleChoiceAnswer();
                    }
                    $choices = $daoChoice->findByQuestion($question->getId());
                    foreach ($choices as $choice) {
                        if ($choice->getChoiceText() == $request->request->get('answer')){
                            $answer->setChoice($choice);
                            break;
                        }
                    }
                    $answer->setText($request->request->get('comment'));
                } else if ($question instanceof ScaleQuestion){
                    if(!$answer){
                        $answer = new ScaleAnswer();
                    }
                    $answer->setText($request->request->get('comment'));
                    $answer->setValue($request->request->get('answer'));
                } else if ($question instanceof Question) {
                    if(!$answer){
                        $answer = new Answer();
                    }
                    $answer->setText($request->request->get('answer'));
                }
                $answer->setQuestion($question);
                $answer->setRespondentSurvey($respSurvey);
                $daoAnswer->persist($answer);
                $daoAnswer->flush();

                return $this->redirect($this->generateUrl('question_show', array('id' => $question->getId())));
            }
            else {
                //niet gemachtigd om de vraag te zien.
            }
        }
        else {
            //question bestaat niet
        }
    }

}
