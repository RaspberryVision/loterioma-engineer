<?php

namespace App\Controller\Web;

use App\Entity\Service;
use App\Entity\ServiceStatus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController
{
    /**
     * @Route("/status", name="status")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $services = $this->getDoctrine()->getRepository(Service::class)->findAll();

        /** @var Service $service */
        foreach ($services as $service) {
            try {
                $fp = fsockopen($service->getHost(), $service->getPort(), $errCode, $errStr, 1);
                $service->addStatus(new ServiceStatus(Service::STATUS_ACTIVE));
                fclose($fp);
            } catch (\Exception $exception) {
                $service->addStatus(new ServiceStatus(Service::STATUS_NOT_AVAILABLE));
            }

            $entityManager->persist($service);
        }

        $entityManager->flush();

        return $this->render(
            'status/index.html.twig',
            [
                'services' => $services,
            ]
        );
    }
}
