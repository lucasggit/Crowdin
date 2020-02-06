<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Projet;
use App\Entity\User;
use App\Form\ProjetType;
use App\Manager\manager;
use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ProjetController extends AbstractController
{
    
    private $params;

    /**
     * @Route("/createProjet", name="create_projet")
     */
    public function Createprojet(Request $request, Manager $Lemanager) {
        
        $user=$this->get('security.token_storage')->getToken()->getUser();
        $this->denyAccessUnlessGranted('EDIT', $user);
       
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            $Lemanager->addProjet($projet, $user);
            return $this->redirectToRoute('my_projets');
        }

        return $this->render('projet/createprojet.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/editProjet/{id}", name="editprojet")
    */
    public function projetedit(Request $request, Manager $Lemanager, $id)    : Response
    {
        
        $user=$this->get('security.token_storage')->getToken()->getUser();
        $this->denyAccessUnlessGranted('EDIT', $user);
        
        $projet =$this->getDoctrine()->getRepository(Projet::class)->find($id);

        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) { 
            $Lemanager->editProjet();
                return $this->redirectToRoute('my_projets');
            }
        
        
        return $this->render('projet/editprojet.html.twig', [
            'form' => $form->createView(),
            'projet' => $projet
        ]);
    }

    /**
     * @Route("/profil/myprojets", name="my_projets")
     */
    public function myprojets(ProjetRepository $repo) {
        
        $user=$this->get('security.token_storage')->getToken()->getUser();
        $this->denyAccessUnlessGranted('EDIT', $user);
        
        $projets = $repo->findByUser($user);

        return $this->render('projet/myprojets.html.twig', [
            'projets' => $projets
        ]);
        }

        /**
     * @Route("/allProjets", name="allProjets")
     */
    public function randprojets(ProjetRepository $repo) {

        $user=$this->get('security.token_storage')->getToken()->getUser();
        $this->denyAccessUnlessGranted('VIEW', $user);
        
        $projets = $repo->findAll();

        return $this->render('projet/allprojets.html.twig', [
            'projets' => $projets
        ]);
        }

        /**
    * @Route("/allProjets/{id}/view", name="view_projet")
    */
    public function projetview(Request $request, Manager $Lemanager, $id)    : Response
    {
        
        $user=$this->get('security.token_storage')->getToken()->getUser();
        $this->denyAccessUnlessGranted('EDIT', $user);
        
        $projet =$this->getDoctrine()->getRepository(Projet::class)->find($id);
        
        return $this->render('projet/projet.html.twig', [
            'projet' => $projet
        ]);
    }
}
