<?php
namespace HRO\SurveyBundle\DataFixtures\ORM;

use HRO\SurveyBundle\Entity\MultipleChoiceAnswer;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use HRO\SurveyBundle\Entity\ScaleQuestion;
use HRO\SurveyBundle\Entity\MultipleChoiceQuestion;

class LoadQuestion extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$question = new ScaleQuestion();
		$question->setQuestionText("Een eerste vraag");
		$question->setSurvey($manager->merge($this->getReference('survey')));
		$question->setRange(5);
		$manager->persist($question);

		$question = new MultipleChoiceQuestion();
		$question->setQuestionText("Een tweede vraag");
		$question->setSurvey($manager->merge($this->getReference('survey')));
		$manager->persist($question);

		$question = new ScaleQuestion();
		$question->setQuestionText("Een derde vraag");
		$question->setSurvey($manager->merge($this->getReference('survey')));
		$question->setRange(10);
		$manager->persist($question);
		
		$manager->flush();
	}
	
	public function getOrder()
	{
		return 4;
	}
}