<?php

namespace App\Controller\Web;

use App\Service\ServiceChecker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="web_app_index")
     * @param ServiceChecker $serviceChecker
     * @return Response
     */
    public function index(ServiceChecker $serviceChecker)
    {
        return $this->render(
            'web/app/index.html.twig',
            [
                'services' => $serviceChecker->getStatus(),
            ]
        );
    }
}
