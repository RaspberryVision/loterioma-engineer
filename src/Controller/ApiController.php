<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/report/{toolName}", name="api_report_post", methods={"POST"})
     * @param Request $request
     * @param string $toolName
     * @return JsonResponse
     */
    public function report(Request $request, string $toolName): JsonResponse
    {
        return $this->json('OK');
    }
}
