<?php
namespace App\Manager;

use App\Entity\Langue;
use App\Entity\User;
use App\Entity\Projet;
use App\Entity\Source;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class manager extends AbstractController
{

    public function addUser(User $user,UserPasswordEncoderInterface $encoder) {

            $manager = $this->getDoctrine()->getManager();
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setCreatedAt(new \DateTime());
            if($user->getLanguage()->count() >= 2) $user->setTraducteur(true);
            else $user->setTraducteur(false);
            $this->created_at = new \DateTime();
            $this->updated_at = new \DateTime();
    
            $manager->persist($user);
            $manager->flush();
    }


    public function editUser(User $user, UserPasswordEncoderInterface $encoder)
    {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            if($user->getLanguage()->count() >= 2) $user->setTraducteur(true);
            else $user->setTraducteur(false);
            $user->setPassword($hash);
                $this->getDoctrine()->getManager()->flush();
    }

    public function addProjet(Projet $projet, User $user) {

            $manager = $this->getDoctrine()->getManager();
            $projet->setUser($manager->getRepository(User::class)->find($this->getUser()));
            $projet->setTraduit(false);
            $projet->setCreatedAt(new \DateTime());

            $this->created_at = new \DateTime();
            $this->updated_at = new \DateTime();
    
            $manager->persist($projet);
            $manager->flush();
        }

    public function editProjet()
    { 
    
        $this->getDoctrine()->getManager()->flush();

        }

        public function addSource(Source $source, Projet $projet, $id) {

            $manager = $this->getDoctrine()->getManager();
            $source->setProjet($manager->getRepository(Projet::class)->find($id));
            $source->setCreatedAt(new \DateTime());

            $this->created_at = new \DateTime();
            $this->updated_at = new \DateTime();
    
            $manager->persist($source);
            $manager->flush();
        }

        public function editSource()
    { 
    
        $this->getDoctrine()->getManager()->flush();

        }

}

