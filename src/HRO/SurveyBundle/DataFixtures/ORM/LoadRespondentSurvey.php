<?php
namespace HRO\SurveyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use HRO\SurveyBundle\Entity\RespondentSurvey;

class LoadRespondentSurvey extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$respondentSurvey = new RespondentSurvey();
		$respondentSurvey->setSurvey($manager->merge($this->getReference('survey')));
		$respondentSurvey->setRespondent($manager->merge($this->getReference('andra')));
		
		$manager->persist($respondentSurvey);
		$manager->flush();
		$this->addReference('respondent_survey', $respondentSurvey);
	}
	
	public function getOrder()
	{
		return 3;
	}
}