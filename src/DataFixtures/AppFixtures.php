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

        for ($i = 0; $i < mt_rand(3, 6); $i++)
        {
            $users[$i] = new User();
            $users[$i] -> setLogin($faker -> name);
            $users[$i] -> setPassword($faker -> password);

            $manager -> persist($users[$i]);
        }

        $posts = array();

        for ($i = 0; $i < mt_rand(3, 12); $i++)
        {
            $posts[$i] = new BlogPost();
            $posts[$i] -> setTitle($faker -> jobTitle);
            $posts[$i] -> setContent($faker -> realText);
            $posts[$i] -> setPicture($faker -> imageUrl());
            $posts[$i] -> setCreatedAt($faker -> dateTimeBetween('-6 months'));

            $manager -> persist($posts[$i]);
        }

        $manager -> flush();
    }
}
