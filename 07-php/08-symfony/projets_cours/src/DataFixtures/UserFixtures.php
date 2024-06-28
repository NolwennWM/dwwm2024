<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 5; $i++)
        {
            $u = new User();
            $u  ->setEmail("user$i@gmail.com")
                ->setPassword($this->hasher->hashPassword($u, "User$i"));
            if($i===0) $u->setRoles(["ROLE_ADMIN"]);
            $manager->persist($u);
        }

        $manager->flush();
    }
    public static function getGroups(): array
    {
        return ["user"];
    }
}
