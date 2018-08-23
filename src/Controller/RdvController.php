<?php

namespace App\Controller;

use App\Entity\Rdv;
use App\Form\RdvType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RdvController
 * @package App\Controller
 */
class RdvController extends AbstractController
{

    /*
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Rdv::class);
        $rdvs = $repository->findAll();


        return $this->render('rdv/index.html.twig', [
            'rdvs' => $rdvs,
        ]);
    }*/
/*
    public function load()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Rdv::class);
        $rdvs = $repository->findAll();


        foreach($rdvs as $rdv)
        {
         $data[] = array(
             'start'        => $rdv->getDateheuredebut(), // dans la table rdv
             'commentaire'  => $rdv->getTextelibre(), // dans la table rdv
             'title'        => $rdv["acte"], // dans la table motif
             'color'        => $rdv["couleur"], // dans la table motif
             'nompatient'   => $rdv["Utilisateur"], // dans la table utilisateur, chaine avec nom et prenom
             'editable'     => true, // event editable ou pas
         );
        }

        echo json_encode($data);


    }
*/

    /**
     * @Route("/rendezvous")
     */
    public function insertionEnBdd(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Rdv::class);
        $rdvs = $repository->findAll();


        /*return $this->render('rdv/index.html.twig', [
            'rdvs' => $rdvs,
        ]);*/

        $rdv = new Rdv();

        /*$rdv->setDateheuredebut(); // date reçue via le cal?*/
        /*$rdv->setUtilisateur($this->getUser());*/


        $form = $this->createForm(RdvType::class, $rdv);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($rdv);
                $em->flush();

                $this->addFlash('success', 'Votre rdv est pris');
                return $this->redirectToRoute('app_rdv_index');
            } else {
                $this->addFlash(
                    'error',
                    'Le formulaire contient des erreurs'
                );
            }
        }

        return $this->render('rdv/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}


