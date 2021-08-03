<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Movie;
use App\Service\OfferTypesEnum;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // 5 Movies as fixtures
        $movie_1 = new Movie();
        $movie_1->setOriginalTitle("Zombieland");
        $movie_1->setTitleDisplay("Bienvenidos a Zombieland");
        $movie_1->setIsAdult(false);
        $movie_1->setPlot("A shy student trying to reach his family in Ohio, a gun-toting bruiser in search of the last Twinkie and a pair of sisters striving to get to an amusement park join forces in a trek across a zombie-filled America.");
        $movie_1->setReleaseDate(DateTime::createFromFormat('d/m/Y', '2/10/2009'));
        $movie_1->setRuntimeMinutes(88);
        $movie_1->setStock(2);
        $movie_1->setOfferType(OfferTypesEnum::None);
        $movie_1->setIdIMDB("tt1156398");
        $movie_2 = new Movie();
        $movie_2->setOriginalTitle("Hot Fuzz");
        $movie_2->setTitleDisplay("Hot Fuzz");
        $movie_2->setIsAdult(false);
        $movie_2->setPlot("A skilled London police officer is transferred to a small town with a dark secret.");
        $movie_2->setReleaseDate(DateTime::createFromFormat('d/m/Y', '16/2/2007'));
        $movie_2->setRuntimeMinutes(121);
        $movie_2->setStock(3);
        $movie_2->setOfferType(OfferTypesEnum::None);
        $movie_2->setIdIMDB("tt0425112");
        $movie_3 = new Movie();
        $movie_3->setOriginalTitle("Serbuan maut");
        $movie_3->setTitleDisplay("Redada asesina");
        $movie_3->setIsAdult(false);
        $movie_3->setPlot("A S.W.A.T. team becomes trapped in a tenement run by a ruthless mobster and his army of killers and thugs.");
        $movie_3->setReleaseDate(DateTime::createFromFormat('d/m/Y', '23/3/2012'));
        $movie_3->setRuntimeMinutes(101);
        $movie_3->setStock(0);
        $movie_3->setOfferType(OfferTypesEnum::None);
        $movie_3->setIdIMDB("tt1899353");
        $movie_4 = new Movie();
        $movie_4->setOriginalTitle("Heat");
        $movie_4->setTitleDisplay("Heat");
        $movie_4->setIsAdult(false);
        $movie_4->setPlot("A group of professional bank robbers start to feel the heat from police when they unknowingly leave a clue at their latest heist.");
        $movie_4->setReleaseDate(DateTime::createFromFormat('d/m/Y', '15/12/1995'));
        $movie_4->setRuntimeMinutes(170);
        $movie_4->setStock(2);
        $movie_4->setOfferType(OfferTypesEnum::None);
        $movie_4->setIdIMDB("tt0113277");
        $movie_5 = new Movie();
        $movie_5->setOriginalTitle("Kōkaku Kidōtai");
        $movie_5->setTitleDisplay("Ghost in the Shell");
        $movie_5->setIsAdult(false);
        $movie_5->setPlot("A cyborg policewoman and her partner hunt a mysterious and powerful hacker called the Puppet Master.");
        $movie_5->setReleaseDate(DateTime::createFromFormat('d/m/Y', '18/11/1995'));
        $movie_5->setRuntimeMinutes(82);
        $movie_5->setStock(1);
        $movie_5->setOfferType(OfferTypesEnum::None);
        $movie_5->setIdIMDB("tt0113568");

        // Two users as fixtures
        $client_1 = new Client();
        $client_2 = new Client();
        $client_1->setName("Gordon");
        $client_1->setLastName("Freeman");
        $client_1->setPhone("912345678");
        $client_1->setAddress("Living Quarters 8-12-3, Black Mesa Research Facility, New Mexico, United States of America");
        $client_1->setEmail("gfreeman@blackmesa.net");
        $client_1->setDateOfBirth(DateTime::createFromFormat('d/m/Y', '8/12/1976'));
        $client_2->setName("Elizabeth");
        $client_2->setLastName("Bray");
        $client_2->setPhone("927342069");
        $client_2->setAddress("Bray Family Quarters 7-7, Eventide, Europa, Sol");
        $client_2->setEmail("elsie.bray@cb.exo");
        $client_2->setDateOfBirth(DateTime::createFromFormat('d/m/Y', '7/7/1998'));

        $manager->persist($movie_1);
        $manager->persist($movie_2);
        $manager->persist($movie_3);
        $manager->persist($movie_4);
        $manager->persist($movie_5);
        $manager->persist($client_1);
        $manager->persist($client_2);
        $manager->flush();
    }
}
