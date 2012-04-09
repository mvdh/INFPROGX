<?php
namespace HRO\SurveyBundle\DataFixtures\ORM;

use \HRO\SurveyBundle\Entity\Question;
use \HRO\SurveyBundle\Entity\Choice;
use \HRO\SurveyBundle\Entity\Survey;
use \HRO\SurveyBundle\Entity\RespondentSurvey;
use HRO\SurveyBundle\Entity\MultipleChoiceQuestion;
use HRO\SurveyBundle\Entity\ScaleQuestion;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use HRO\SurveyBundle\Entity\User;

class LoadData extends AbstractFixture
{
	public function load(ObjectManager $manager)
	{
        //================//

        $users = array();

        $user_names = array('andra', 'maarten');
        foreach ($user_names as $name) {
            $user = new User();
            $user->setUsername($name);
            $user->setPassword($name);
            $user->setEmailAddress($name . '@gmail.com');
            $manager->persist($user);
            $users[] = $user;
        }

        //================//

        $surveys = array();

        $survey_names = array('Kleuren', 'Computers', 'South Park');
        foreach ($survey_names as $name){
            $survey = new Survey();
            $survey->setTitle($name);
            $survey->setOwner($users[rand(0,count($users)-1)]);
            $manager->persist($survey);
            $surveys[$name] = $survey;
        }

        //================//

        $surveys_questions = array(
            'Kleuren' => array(
                'Welke kleur vind je het leukst?' => array('type' => 'm', 'choices' => array('Geel', 'Paars', 'Blauw', 'Groen', 'Rood')),
                'Hoe leuk vind je de kleur beige?' => array('type' => 's', 'range' => 5, 'low' => 'Helemaal niet', 'high' => 'Fantastisch'),
                'Vind je de kleur bruin leuk?' => array('type' => 'm', 'choices' => array('Ja', 'Nee')),
                'Hoe licht is de kleur van de tafel?' => array('type' => 's', 'range' => 5, 'low' => 'Heel donker', 'high' => 'Heel licht'),
                'Beschrijf je gemoedstoestand als je denkt aan de kleur turquoise:' => array('type' => 'q')
            ),
            'Computers' => array(
                'Mac of PC?' => array('type' => 'm', 'choices' => array('PC', 'Mac')),
                'Windows, Linux of OSX?' => array('type' => 'm', 'choices' => array('Linux', 'Windows')),
                'Hoeveel computers bezit u?' => array('type' => 'm', 'choices' => array('4 of meer', '3', '2', '1', 'Geen')),
                'Windows zuigt...' => array('type' => 's', 'range' => 5, 'low' => 'Best veel', 'high' => 'Ontzettend veel'),
                'Waarom vindt u dat Steve Balmer ontslagen moet worden?' => array('type' => 'q')
            ),
            'South Park' => array(
                'Stan, Kyle, Cartman of Kenny?' => array('type' => 'm', 'choices' => array('Stan', 'Kenny', 'Cartman', 'Kyle')),
                'Moet Kenny echt iedere aflevering dood gaan?' => array('type' => 'm', 'choices' => array('Ja', 'Nee')),
                'Is het je ooit opgevallen dat alleen Cartman altijd zijn achternaam wordt genoemd?' => array('type' => 'm', 'choices' => array('Ja', 'Nee')),
                'Hoe waarschijnlijk is het dat South Park eerder stopt dan dat het stop met grappig zijn?' => array('type' => 's', 'range' => 5, 'low' => 'Helemaal niet waarschijnlijk', 'high' => 'Zeer waarschijnlijk'),
                'Beschrijf waarom Matt Stone een betere presidentskandidaat is dan Trey Parker:' => array('type' => 'q')
            )
        );

        foreach($surveys_questions as $survey_name => $survey_questions){
            foreach($survey_questions as $question => $question_info){
                switch($question_info['type']){
                    case 'm':
                        $mcq = new MultipleChoiceQuestion();
                        $mcq->setQuestionText($question);
                        $mcq->setSurvey($surveys[$survey_name]);
                        $manager->persist($mcq);
                        foreach($question_info['choices'] as $choice_text) {
                            $choice = new Choice();
                            $choice->setChoiceText($choice_text);
                            $choice->setQuestion($mcq);
                            $manager->persist($choice);
                        }
                        break;
                    case 's':
                        $sq = new ScaleQuestion();
                        $sq->setQuestionText($question);
                        $sq->setSurvey($surveys[$survey_name]);
                        $sq->setRange($question_info['range']);
                        $sq->setTextLow($question_info['low']);
                        $sq->setTextHigh($question_info['high']);
                        $manager->persist($sq);
                        break;
                    case 'q':
                        $q = new Question();
                        $q->setQuestionText($question);
                        $q->setSurvey($surveys[$survey_name]);
                        $manager->persist($q);
                        break;
                }
            }
        }

        //================//

        $respondentSurveys = array();

        foreach ($users as $user) {
            foreach($surveys as $survey){
                if (rand(0,1) == 1){
                    $respondentSurvey = new RespondentSurvey();
                    $respondentSurvey->setSurvey($survey);
                    $respondentSurvey->setRespondent($user);
                    $manager->persist($respondentSurvey);
                    $respondentSurveys[] = $respondentSurvey;
                }
            }
        }

        //================//

        $manager->flush();
	}
}