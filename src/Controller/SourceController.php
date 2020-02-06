<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Source;
use App\Form\SourceType;
use App\Manager\manager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SourceController extends AbstractController
{
    /**
     * @Route("/profil/myprojets/{id}/createSource", name="create_source")
     */
    public function Createsource(Request $request, manager $Lemanager, Projet $projet, $id) {
        
        $user=$this->get('security.token_storage')->getToken()->getUser();
        $this->denyAccessUnlessGranted('EDIT', $user);
       
        $source = new Source();
        $form = $this->createForm(SourceType::class, $source);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            $Lemanager->addSource($source, $projet, $id);
            return $this->redirectToRoute('my_projets');
        }

        return $this->render('source/createsource.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/editSource/{id}", name="edit_source")
    */
    public function sourceedit(Request $request, Manager $Lemanager, $id)
    {
        
        $user=$this->get('security.token_storage')->getToken()->getUser();
        $this->denyAccessUnlessGranted('EDIT', $user);
        
        $source =$this->getDoctrine()->getRepository(Source::class)->find($id);

        $form = $this->createForm(SourceType::class, $source);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) { 
            $Lemanager->editSource();
                return $this->redirectToRoute('my_projets');
            }
        
        
        return $this->render('source/editsource.html.twig', [
            'form' => $form->createView(),
            'source' => $source
        ]);
    }

    /**
    * @Route("/viewSource/{id}", name="view_source")
    */
    public function sourceview(Request $request, Manager $Lemanager, $id)
    {
        
        $user=$this->get('security.token_storage')->getToken()->getUser();
        $this->denyAccessUnlessGranted('EDIT', $user);
        
        $source =$this->getDoctrine()->getRepository(Source::class)->find($id);

        return $this->render('source/source.html.twig', [
            'source' => $source
        ]);
    }
}
