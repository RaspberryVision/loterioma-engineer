<?php

namespace App\Service;

use App\Entity\Service;
use App\Entity\ServiceStatus;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ServiceChecker
 *
 * @author Rafal Malik <rafalmalik.info@gmail.com>
 * @package App\Service
 */
class ServiceChecker
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * ServiceChecker constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get services with updated status.
     */
    public function getStatus()
    {
        $services = $this->getServices();
        foreach ($services as $service) {
            $service->addStatus(new ServiceStatus($this->ping($service)));
            $this->entityManager->persist($service);
        }
        $this->entityManager->flush();

        return $services;
    }

    /**
     * @return Service[]|null
     */
    private function getServices()
    {
        return $this->entityManager->getRepository(Service::class)->findAll();
    }

    /**
     * @param Service $service
     * @return int
     */
    private function ping(Service $service)
    {
        try {
            $fp = fsockopen($service->getHost(), $service->getPort(), $errCode, $errStr, 1);
            fclose($fp);
        } catch (\Exception $exception) {
            return Service::STATUS_NOT_AVAILABLE;
        }

        return Service::STATUS_ACTIVE;
    }

}