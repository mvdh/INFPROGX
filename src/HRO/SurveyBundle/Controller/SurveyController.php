<?php

namespace HRO\SurveyBundle\Controller;

use HRO\SurveyBundle\Entity\RespondentSurvey;
use HRO\SurveyBundle\Entity\Survey;
use HRO\SurveyBundle\Dao\DaoAnswer;
use HRO\SurveyBundle\Dao\DaoQuestion;
use HRO\SurveyBundle\Dao\DaoSurvey;
use HRO\SurveyBundle\Dao\DaoUser;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class SurveyController extends Controller
{
    
    public function listAction()
    {
        $daoSurvey = $this->get('dao_survey');
        $daoRespSurvey = $this->get('dao_respondent_survey');

        $allSurveys = array();
        foreach($daoSurvey->findAll() as $survey){
            $allSurveys[$survey->getId()] = $survey;
        }

        $enrolledSurveys = null;
        $notEnrolledSurveys = $allSurveys;
        $user = $this->get('security.context')->getToken()->getUser();
        if($user && $user != 'anon.') {
            $enrolledSurveys = array();
            foreach($daoRespSurvey->findByRespondent($user->getId()) as $respSurvey){
                $enrolledSurveys[$respSurvey->getSurvey()->getId()] = $respSurvey->getSurvey();
            }
            $notEnrolledSurveys = array_diff_key($allSurveys, $enrolledSurveys);
        }

        return $this->render(
            'HROSurveyBundle:Default:surveys.html.twig',
            array(
                'not_enrolled_surveys' => $notEnrolledSurveys,
                'enrolled_surveys' => $enrolledSurveys,
            )
        );
    }

    public function addAction($id) {
        $user = $this->get('security.context')->getToken()->getUser();
        if($user && $user != 'anon.') {
            $daoRespSurvey = $this->get('dao_respondent_survey');
            $daoSurvey = $this->get('dao_survey');

            if(!$daoRespSurvey->exists($user->getId(), $id)){
                $respSurvey = new RespondentSurvey();
                $respSurvey->setSurvey($daoSurvey->findById($id));
                $respSurvey->setRespondent($user);

                $daoRespSurvey->persist($respSurvey);
                $daoRespSurvey->flush();
            }
        }
        return $this->redirect($this->generateUrl('survey_list'));
    }

    public function removeAction($id) {
        $user = $this->get('security.context')->getToken()->getUser();
        if($user && $user != 'anon.') {
            $daoRespSurvey = $this->get('dao_respondent_survey');
            $respSurvey = $daoRespSurvey->findByRespondentSurvey($user->getId(), $id);
            if($respSurvey && !$respSurvey->getCompleted()){
                $daoAnswer = $this->get('dao_answer');
                $daoAnswer->removeAnswers($respSurvey->getId());
                $daoRespSurvey->remove($respSurvey);
                $daoRespSurvey->flush();
            }
        }
        return $this->redirect($this->generateUrl('survey_list'));
    }


    public function editAction(Request $request, $id)
    {
        $daoSurvey = $this->get('dao_survey');

        // retrieving the security identity of the currently logged-in user
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $securityIdentity = UserSecurityIdentity::fromAccount($user);

        if($id == 'nieuw')
        {
            $survey = new Survey();
            $survey->setOwner($user);
        }
        else
        {
            $survey = $daoSurvey->findById($id);
            if(!$survey){
                return $this->redirect($this->generateUrl('survey_edit', array('id' => 'nieuw')));
            }
            if (false === $securityContext->isGranted('EDIT', $survey))
            {
                throw new AccessDeniedException();
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

                // creating the ACL
                $aclProvider = $this->get('security.acl.provider');
                $objectIdentity = ObjectIdentity::fromDomainObject($survey);
                $acl = $aclProvider->createAcl($objectIdentity);

                // grant owner access
                $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
                $aclProvider->updateAcl($acl);

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
