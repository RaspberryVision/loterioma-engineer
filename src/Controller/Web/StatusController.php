<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController
{
    /**
     * @Route("/status", name="status")
     */
    public function index()
    {
        $host = 'loterioma_manager1';
        $port = 80;
        $waitTimeoutInSeconds = 1;
        if($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){
            var_dump('works');
        } else {
            var_dump('no works');
            // It didn't work
        }
        fclose($fp);

        return $this->render('status/index.html.twig', [
            'controller_name' => 'StatusController',
        ]);
    }
}
