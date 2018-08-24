<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class SecurityController
 * @package App\Controller
 *
 */
 class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur/{id}", defaults={"id": null}, requirements={"id"="\d+"})
     */
    public function profil(Utilisateur $utilisateur)
    {

        $aujourdhui = new \DateTime();

        $verif = true;


        if (!empty($_POST)){

            if (empty($_POST['prenom'])){
                $this->addFlash('error', 'Le prénom ne doit pas être vide');
                $verif = false;
            }
            if (empty($_POST['nom'])){
                $this->addFlash('error', 'Le nom ne doit pas être vide');
                $verif = false;
            }

            $dateNaissance = new \DateTime();
            $valeurDate = explode("-", $_POST['dateNaissance']);

            if (!empty($_POST['dateNaissance'])){
                if (strlen($valeurDate[0]) > 4){
                    $this->addFlash('error', 'la date de naissance est invalide');
                    $verif = false;
                }
                if ($valeurDate[0] < 1920){
                    $this->addFlash('error', 'la date de naissance est invalide');
                }

                $dateNaissance->format($_POST['dateNaissance']);
                $dateNaissance->setDate($valeurDate[0], $valeurDate[1], $valeurDate[2]);

            }

            if ($verif){
                $utilisateur->setPrenom($_POST['prenom']);
                $utilisateur->setNom($_POST['nom']);
                $utilisateur->setTelephone($_POST['telephone']);
                $utilisateur->setAdresse($_POST['adresse']);
                $utilisateur->setVille($_POST['ville']);
                $utilisateur->setDateNaissance($dateNaissance);
                $utilisateur->setCp($_POST['cp']);
                $utilisateur->setCommentaire($_POST['commentaire']);

                $em = $this->getDoctrine()->getManager();

                $em->persist($utilisateur);
                $em->flush();

                $this->addFlash('success', 'Votre compte est bien modifié');

               return $this->redirectToRoute('app_utilisateur_profil', [
                    'id' => $utilisateur->getId()
                ]);

            }

        }

        return $this->render('utilisateur/index.html.twig', [
            'utilisateur'   => $utilisateur,
            'aujourdhui'    => $aujourdhui
        ]);

    }

     /**
      * @Route("/listerdv/{id}", defaults={"id": null}, requirements={"id"="\d+"})
      */
     public function listeRdv (Utilisateur $utilisateur)
     {

         $rdvs = $utilisateur->getRdv();

         return $this->render('utilisateur/listeRdv.html.twig', [
             'rdvs' => $rdvs,
             'utilisateur' => $utilisateur
         ]);

     }
}
