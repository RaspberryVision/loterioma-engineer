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

        $results = [];
        /** @var Service $service */
        foreach ($services as $service) {
            if ($fp = fsockopen($service->getHost(), $service->getPort(), $errCode, $errStr, 1)) {

            } else {
                var_dump('no works');
                // It didn't work
            }
            fclose($fp);
        }

        return $this->render(
            'status/index.html.twig',
            [
                'controller_name' => 'StatusController',
            ]
        );
    }
}
