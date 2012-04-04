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
        $daoSurvey = new DaoSurvey($this->container);
        $surveys = $daoSurvey->findAll();
        return $this->render('HROSurveyBundle:Default:surveys.html.twig', array('surveys' => $surveys));
    }

    public function newAction(Request $request)
    {
        $daoUser = new DaoUser($this->container);
        $daoSurvey = new DaoSurvey($this->container);

        $owner = $daoUser->findOneByUsername('maarten');

        $survey = new Survey();
        $survey->setOwner($owner);

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

                return $this->redirect($this->generateUrl('HROSurveyBundle_SurveyList'));
            }
        }

        return $this->render('HROSurveyBundle:Default:survey_new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function showAction(Request $request, $id)
    {
        $daoQuestion = new DaoQuestion($this->container);
        $daoSurvey = new DaoSurvey($this->container);

        $survey = $daoSurvey->findById($id);
        $questions = $daoQuestion->findBySurvey($id);

        return $this->render('HROSurveyBundle:Default:survey_show.html.twig', array(
            'survey' => $survey,
            'questions' => $questions,
        ));
    }
}
