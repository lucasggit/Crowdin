<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CrowdInController extends AbstractController
{
    /**
     * @Route("/crowdin", name="crowd_in")
     */
    public function index()
    {
        return $this->render('crowd_in/index.html.twig', [
            'controller_name' => 'CrowdInController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->render('crowd_in/home.html.twig');
    }

    /**
     * @Route("/compte", name="compte")
     */
    public function compte() {
        return $this->render('crowd_in/compte.html.twig');
    }

    /**
     * @Route("/projets", name="projets")
     */
    public function projets() {
        return $this->render('crowd_in/projets.html.twig');
    }

    /**
     * @Route("/traducteurs", name="traducteurs")
     */
    public function traducteurs() {
        return $this->render('crowd_in/traducteurs.html.twig');
    }
}
