<?php

namespace HRO\SurveyBundle\Controller;

use HRO\SurveyBundle\Entity\Survey;
use HRO\SurveyBundle\Dao\DaoAnswer;
use HRO\SurveyBundle\Dao\DaoQuestion;
use HRO\SurveyBundle\Entity\RespondentSurvey;
use HRO\SurveyBundle\Dao\DaoSurvey;
use HRO\SurveyBundle\Dao\DaoUser;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class SurveyController extends Controller
{
    
    public function listAction()
    {
        $daoSurvey = $this->get('dao_survey');
        $surveys = $daoSurvey->findAll();
        return $this->render('HROSurveyBundle:Default:surveys.html.twig', array('surveys' => $surveys));
    }

    public function editAction(Request $request, $id)
    {
        $daoUser = $this->get('dao_user');
        $daoSurvey = $this->get('dao_survey');

        if($id == 'nieuw')
        {
            $owner = $daoUser->findOneByUsername('maarten');
            $survey = new Survey();
            $survey->setOwner($owner);
        }
        else
        {
            $survey = $daoSurvey->findById($id);
            if(!$survey){
                return $this->redirect($this->generateUrl('survey_edit', array('id' => 'nieuw')));
            }
        }

        $form = $this->createFormBuilder($survey)
            ->add('title', 'text', array(
                'label'  => 'Enquete titel',
            ))
            ->getForm();

        if($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if($form->isValid()) {
                $daoSurvey->persist($survey);
                $daoSurvey->flush();

                return $this->redirect($this->generateUrl('survey_list'));
            }
        }

        return $this->render('HROSurveyBundle:Default:survey_edit.html.twig', array(
            'id' => $id,
            'form' => $form->createView(),
        ));
    }

    public function showAction(Request $request, $id)
    {
        $daoQuestion = $this->get('dao_question');
        $daoSurvey = $this->get('dao_survey');

        $survey = $daoSurvey->findById($id);
        $questions = $daoQuestion->findBySurvey($id);

        return $this->render('HROSurveyBundle:Default:survey_show.html.twig', array(
            'survey' => $survey,
            'questions' => $questions,
        ));
    }
}
