<?php

namespace App\DataFixtures;

use App\Entity\ListToDo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ListFixtures extends Fixture implements DependentFixtureInterface
{
    public const LIST_ITEM_REFERENCE = 'list-item';
    public const LIST_ITEM_REFERENCE2 = 'list-item-2';

    public function load(ObjectManager $manager): void
    {
        $list = new ListToDo();
        $list->setName('ListToDo1');
        $list->setUserId($this->getReference(UserFixtures::USER_LIST_REFERENCE));
        $manager->persist($list);

        $list1 = new ListToDo();
        $list1->setName('ListToDo2');
        $list1->setUserId($this->getReference(UserFixtures::USER_LIST_REFERENCE));
        $manager->persist($list1);

        $list2 = new ListToDo();
        $list2->setName('ListToDo1');
        $list2->setUserId($this->getReference(UserFixtures::USER_LIST_REFERENCE2));
        $manager->persist($list2);

        $manager->flush();
        $this->addReference(self::LIST_ITEM_REFERENCE, $list);
        $this->addReference(self::LIST_ITEM_REFERENCE2, $list2);
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
