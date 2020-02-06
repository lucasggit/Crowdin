<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CrowdinController extends AbstractController
{
    /**
     * @Route("/", name="crowdin")
     */
    public function index()
    {
        return $this->render('crowdin/index.html.twig', [
            'controller_name' => 'CrowdinController',
        ]);
    }

}
