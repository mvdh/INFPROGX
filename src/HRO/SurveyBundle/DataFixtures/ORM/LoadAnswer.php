<?php
namespace HRO\SurveyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use HRO\SurveyBundle\Entity\Answer;
use HRO\SurveyBundle\Entity\ScaleAnswer;
use HRO\SurveyBundle\Entity\MultipleChoiceAnswer;

class LoadAnswer extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{		
		$scaleAnswer = new ScaleAnswer();
		$scaleAnswer->setQuestion($manager->merge($this->getReference('scale_question')));
		$scaleAnswer->setValue(4);
		$scaleAnswer->setRespondentSurvey($this->getReference('respondent_survey'));
		$manager->persist($scaleAnswer);

		$multipleChoiceAnswer = new MultipleChoiceAnswer();
		$multipleChoiceAnswer->setQuestion($this->getReference('multiple_choice_question'));
		$multipleChoiceAnswer->setChoice($this->getReference('choice'));
		$multipleChoiceAnswer->setRespondentSurvey($this->getReference('respondent_survey'));
		$multipleChoiceAnswer->setText('Dit is commentaar');
		$manager->persist($multipleChoiceAnswer);

		$answer = new Answer();
		$answer->setQuestion($this->getReference('question'));
		$answer->setRespondentSurvey($this->getReference('respondent_survey'));
		$answer->setText('Dit is het antwoord op de vraag');
		$manager->persist($answer);
		
		$manager->flush();
	}
	
	public function getOrder()
	{
		return 5;
	}
}