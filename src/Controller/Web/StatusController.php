<?php

namespace App\Controller\Web;

use App\Service\ServiceChecker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController
{
    /**
     * @Route("/status", name="status")
     * @param ServiceChecker $serviceChecker
     * @return Response
     */
    public function index(ServiceChecker $serviceChecker)
    {
        return $this->render(
            'status/index.html.twig',
            [
                'services' => $serviceChecker->getStatus(),
            ]
        );
    }
}
