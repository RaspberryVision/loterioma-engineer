<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $service = new Service('Manager App', 'loterioma_manager');
        // $product = new Product();
        // $manager->persist($product);
        $manager->persist($service);

        $manager->flush();
    }
}
