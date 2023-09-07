<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Dishes;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher) {
        $this->passwordHasher = $passwordHasher;
        
    }

    public function load(ObjectManager $manager): void
    {
         $john = new Admin($this->passwordHasher);
         $john->setEmail("Frank.Capra@hotmail.com")->setPassword("Kreia22EruditVidal69*")->setRoles(["ROLE_ADMIN"]);
         $manager->persist($john);

         $fred = new User($this->passwordHasher);
         $fred->setEmail("Henry.Dewaere@hotmail.com")->setPassword("SerieVal23Shan255*")->setRoles(["ROLE_USER"])->setName("Dewaere")->setFirstname("Henry")->setPhone("0707070707");
         $manager->persist($fred);
         
         


         $manager->flush();

    }

    
}
