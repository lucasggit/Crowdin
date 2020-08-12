<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EcoachController extends AbstractController
{
    /**
     * @Route("/", name="ecoach")
     */
    public function index()
    {
        return $this->render('ecoach/index.html.twig', [
            'controller_name' => 'EcoachController',
        ]);
    }

    /**
     * @Route("/produits", name="produits")
     */
    public function produits()
    {
        return $this->render('ecoach/produits.html.twig', [
            'controller_name' => 'EcoachController',
        ]);
    }
    
    /**
     * @Route("/calendrier", name="calendrier")
     */
    public function calendrier()
    {
        return $this->render('ecoach/calendrier.html.twig', [
            'controller_name' => 'EcoachController',
        ]);
    }
    
    /**
     * @Route("/support", name="support")
     */
    public function support()
    {
        return $this->render('ecoach/support.html.twig', [
            'controller_name' => 'EcoachController',
        ]);
    }
    
    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('ecoach/contact.html.twig', [
            'controller_name' => 'EcoachController',
        ]);
    }
    
    /**
     * @Route("/informations", name="informations")
     */
    public function informations()
    {
        return $this->render('ecoach/informations.html.twig', [
            'controller_name' => 'EcoachController',
        ]);
    }
    
    /**
     * @Route("/messages", name="messages")
     */
    public function messages()
    {
        return $this->render('ecoach/messages.html.twig', [
            'controller_name' => 'EcoachController',
        ]);
    }
}
