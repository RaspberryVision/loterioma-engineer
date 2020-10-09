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
        $manager->persist($service);

        $service = new Service('Lobby App', 'loterioma_lobby');
        $manager->persist($service);

        $service = new Service('Manager Database', 'loterioma_manager_db', 3306);
        $manager->persist($service);

        $service = new Service('Lobby Database', 'loterioma_lobby_db', 3306);
        $manager->persist($service);

        $service = new Service('Core App', 'loterioma_core');
        $manager->persist($service);

        $service = new Service('Engine App', 'loterioma_engine');
        $manager->persist($service);

        $service = new Service('DataStore Db', 'db', 5432);
        $manager->persist($service);

        $service = new Service('DataStore API', 'api');
        $manager->persist($service);

        // infrastructure
        $service = new Service('Infrastructure - Rabbit', 'loterioma_infrastructure_rabbit', 5672);
        $manager->persist($service);

        $service = new Service('Infrastructure - Redis', 'loterioma_infrastructure_redis', 6379);
        $manager->persist($service);

        $service = new Service('Infrastructure - PhpMyAdmin', 'loterioma_infrastructure_phpmyadmin');
        $manager->persist($service);

        $service = new Service('Infrastructure - PhpMyAdmin', 'loterioma_infrastructure_phpmyadmin');
        $manager->persist($service);

        $service = new Service('Infrastructure - LocalStack', 'loterioma_infrastructure_aws', 4566);
        $manager->persist($service);


        $manager->flush();


    }
}
