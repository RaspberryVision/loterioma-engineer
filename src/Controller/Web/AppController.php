<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/web/app", name="web_app")
     */
    public function index(): Response
    {
        return $this->render('web/app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }
}
