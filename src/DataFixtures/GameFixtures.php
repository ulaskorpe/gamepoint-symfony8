<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Game;
use App\Entity\Category;
class GameFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create();
    

        $categories = [];

        // CATEGORY CREATE
        for ($i = 0; $i < 10; $i++) {

            $category = new Category();

            $category->setTitle($faker->words(3, true));
            $category->setDescription($faker->sentences(3, true));
            $manager->persist($category);

            $categories[] = $category;
        }

        for ($i = 0; $i < 20; $i++) {

            $game = new Game();

            $game->setTitle($faker->words(3, true));
            $game->setDescription($faker->sentence());
            $game->setImage('https://picsum.photos/640/480?random='.rand(1,9999));
            $game->setCategory(
                $categories[array_rand($categories)]
            );
            $manager->persist($game);
        }

        $manager->flush();

         
    }
}
