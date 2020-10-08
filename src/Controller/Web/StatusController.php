<?php

namespace App\Controller\Web;

use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController
{
    /**
     * @Route("/status", name="status")
     */
    public function index()
    {
        $services = $this->getDoctrine()->getRepository(Service::class)->findAll();

        /** @var Service $service */
        foreach ($services as $service) {
            try {
                if ($fp = fsockopen($service->getHost(), $service->getPort(), $errCode, $errStr, 1)) {
                    $service->setStatus(1);
                } else {
                    $service->setStatus(2);
                }
                fclose($fp);
            } catch (\Exception $exception) {
                $service->setStatus(Service::STATUS_NOT_AVAILABLE);
            }
        }

        return $this->render(
            'status/index.html.twig',
            [
                'services' => $services,
            ]
        );
    }
}
