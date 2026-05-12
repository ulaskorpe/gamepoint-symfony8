<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('tr_TR');

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($faker->unique()->userName());
            $user->setName($faker->name());
            $user->setEmail($faker->unique()->safeEmail());
            $user->setPassword($this->passwordHasher->hashPassword($user, '123123'));
            // API için benzersiz, tahmin edilemez token (64 hex karakter)
            $user->setApiToken(bin2hex(random_bytes(32)));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
