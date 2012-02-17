<?php
namespace HRO\SurveyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use HRO\SurveyBundle\Entity\User;

class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$userMaarten = new User();
		$userMaarten->setUsername('maarten');
		$userMaarten->setPassword('maarten');
		$userMaarten->setEmailAddress('maartenvandenhoek@gmail.com');
		$manager->persist($userMaarten);

		$userAndra = new User();
		$userAndra->setUsername('andra');
		$userAndra->setPassword('andra');
		$userAndra->setEmailAddress('andra.veraart@gmail.com');		
		$manager->persist($userAndra);
		
		$manager->flush();
		$this->addReference('maarten', $userMaarten);
		$this->addReference('andra', $userAndra);
	}
	
	public function getOrder()
	{
		return 1;
	}
}