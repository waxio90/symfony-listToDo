<?php

namespace App\DataFixtures;

use App\Entity\ItemToDo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $item = new ItemToDo();
        $item->setName('ItemToDo1');
        $item->setDone(false);
        $item->setListToDo($this->getReference(ListFixtures::LIST_ITEM_REFERENCE));
        $manager->persist($item);

        $item2 = new ItemToDo();
        $item2->setName('ItemToDo2');
        $item2->setDone(false);
        $item2->setListToDo($this->getReference(ListFixtures::LIST_ITEM_REFERENCE));
        $manager->persist($item2);

        $item3 = new ItemToDo();
        $item3->setName('ItemToDo3');
        $item3->setDone(false);
        $item3->setListToDo($this->getReference(ListFixtures::LIST_ITEM_REFERENCE));
        $manager->persist($item3);

        $item4 = new ItemToDo();
        $item4->setName('ItemToDo1');
        $item4->setDone(false);
        $item4->setListToDo($this->getReference(ListFixtures::LIST_ITEM_REFERENCE2));
        $manager->persist($item4);

        $item5 = new ItemToDo();
        $item5->setName('ItemToDo2');
        $item5->setDone(false);
        $item5->setListToDo($this->getReference(ListFixtures::LIST_ITEM_REFERENCE2));
        $manager->persist($item5);

        $item6 = new ItemToDo();
        $item6->setName('ItemToDo3');
        $item6->setDone(false);
        $item6->setListToDo($this->getReference(ListFixtures::LIST_ITEM_REFERENCE2));
        $manager->persist($item6);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ListFixtures::class,
        ];
    }
}
