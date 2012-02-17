<?php
namespace HRO\SurveyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use HRO\SurveyBundle\Entity\Survey;

class LoadSurvey extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$survey = new Survey();
		$survey->setTitle("Een eerste enquete");
		$survey->setOwner($manager->merge($this->getReference('maarten')));
		
		$manager->persist($survey);
		$manager->flush();
		$this->addReference('survey', $survey);
	}
	
	public function getOrder()
	{
		return 2;
	}
}