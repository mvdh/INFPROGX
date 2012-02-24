<?php
namespace HRO\SurveyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use HRO\SurveyBundle\Entity\Choice;
use HRO\SurveyBundle\Entity\Question;
use HRO\SurveyBundle\Entity\ScaleQuestion;
use HRO\SurveyBundle\Entity\MultipleChoiceQuestion;

class LoadQuestion extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$scaleQuestion = new ScaleQuestion();
		$scaleQuestion->setQuestionText("Een eerste vraag");
		$scaleQuestion->setSurvey($manager->merge($this->getReference('survey')));
		$scaleQuestion->setRange(5);
		$manager->persist($scaleQuestion);

		$multipleChoiceQuestion = new MultipleChoiceQuestion();
		$multipleChoiceQuestion->setQuestionText("Een tweede vraag");
		$multipleChoiceQuestion->setSurvey($manager->merge($this->getReference('survey')));
		$manager->persist($multipleChoiceQuestion);

		$choice = new Choice();
		$choice->setChoiceText('Keuze 1 op vraag 2');
		$choice->setQuestion($multipleChoiceQuestion);
		$manager->persist($choice);

		$choice = new Choice();
		$choice->setChoiceText('Keuze 2 op vraag 2');
		$choice->setQuestion($multipleChoiceQuestion);
		$manager->persist($choice);
		
		$choice = new Choice();
		$choice->setChoiceText('Keuze 3 op vraag 2');
		$choice->setQuestion($multipleChoiceQuestion);
		$manager->persist($choice);
		
		$choice = new Choice();
		$choice->setChoiceText('Keuze 4 op vraag 2');
		$choice->setQuestion($multipleChoiceQuestion);
		$manager->persist($choice);
		
		$question = new Question();
		$question->setQuestionText("Een derde vraag");
		$question->setSurvey($manager->merge($this->getReference('survey')));
		$manager->persist($question);
		
		$manager->flush();
		
		$this->addReference('scale_question', $scaleQuestion);
		$this->addReference('multiple_choice_question', $multipleChoiceQuestion);
		$this->addReference('question', $question);
		$this->addReference('choice', $choice);
	}
	
	public function getOrder()
	{
		return 4;
	}
}