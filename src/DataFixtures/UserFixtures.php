<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const USER_LIST_REFERENCE = 'user-list';
    public const USER_LIST_REFERENCE2 = 'user-list-2';
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user10@user.pl');
        $password = $this->passwordHasher->hashPassword($user, 'user123');
        $user->setPassword($password);
        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('user20@user.pl');
        $password2 = $this->passwordHasher->hashPassword($user2, 'user123');
        $user2->setPassword($password2);
        $manager->persist($user2);

        $manager->flush();
        $this->addReference(self::USER_LIST_REFERENCE, $user);
        $this->addReference(self::USER_LIST_REFERENCE2, $user2);
    }
}
