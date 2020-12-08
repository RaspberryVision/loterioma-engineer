<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/", name="api_index")
     */
    public function index()
    {
        return $this->json([
            'name' => 'Loterioma Engineer',
            'slug' => 'loterioma_engineer',
            'port' => '9902',
            'time' => time()
        ]);
    }

    /**
     * @Route("/report/{toolName}", name="api_report_post", methods={"POST"})
     * @param Request $request
     * @param string $toolName
     * @return JsonResponse
     */
    public function report(Request $request, string $toolName): JsonResponse
    {
        $machine = $request->get('machine');
        $component = $request->get('component');

        /** @var UploadedFile $reportFile */
        $reportFile = $request->files->get('report');

        if ($reportFile) {
            $newFilename = $toolName . '.' . $reportFile->guessExtension();

            try {
                $reportFile->move(
                    $this->getParameter('report_directory') . '/' . $machine . '/' . date('ddmmY_Hi') . '/' . $component,
                    $newFilename
                );
            } catch (FileException $e) {
                return $this->json($e->getMessage());
            }
        }

        return $this->json('OK');
    }
}
