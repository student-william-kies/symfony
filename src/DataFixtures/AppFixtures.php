<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $users = array();

        for ($i = 0; $i < 10; $i++)
        {
            $users[$i] = new User();
            $users[$i] -> setLogin($faker -> name);
            $users[$i] -> setPassword($faker -> password);

            $manager -> persist($users[$i]);
        }

        $posts = array();
        for ($i = 0; $i < 20; $i++)
        {
            $posts[$i] = new BlogPost();
            $posts[$i] -> setTitle($faker -> title);
            $posts[$i] -> setContent($faker -> paragraph);
            $posts[$i] -> setPicture($faker -> imageUrl);
            $posts[$i] -> setCreatedAt($faker -> dateTime);

            $manager -> persist($posts[$i]);
        }

        $manager -> flush();
    }
}
