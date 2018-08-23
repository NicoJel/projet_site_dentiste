<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * Class PatientController
 * @package App\Controller\Admin
 */
class PatientController extends AbstractController
{
    /**
     * @Route("/patient")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Utilisateur::class);
        // -- tous les patients triées par nom croissant
        $patients = $repository->findBy([], ['nom' => 'asc']);

        dump($patients);


        return $this->render(
            'admin/patient/index.html.twig',
            [
                'patients' => $patients
            ]
        );
    }

    /**
     * @Route("/suppression/{id}")
     */
    public function delete(Utilisateur $patient)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($patient);
        $em->flush();

        $this->addFlash(
            'success',
            'Le patient est supprimé'
        );

        return $this->redirectToRoute('app_admin_patient_index');
    }

    /**
     * @Route("/patient/{id}")
     */
    public function infos(Utilisateur $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Utilisateur::class);
        $patient = $repository->find($id);

        dump($id);
        dump($patient);

        return $this->render(
            'admin/patient/infos.html.twig',
            [
                'patient' => $patient
            ]
        );
    }

    /**
     * @param Request $request
     * @Route("/test")
     * @return Response
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $utilisateurs =  $em->getRepository(Utilisateur::class)->findBy(['nom' => 'asc']);

        if(!$utilisateurs) {
            $result['utilisateurs']['erreur'] = "Le patient n'existe pas";
        } else {
            $result['utilisateurs'] = $this->getRealEntities($utilisateurs);
        }
        return new Response(json_encode($result));
    }

    public function getRealEntities($utilisateurs){
        foreach ($utilisateurs as $patient){
            $utilisateursReels[$patient->getId()] = $entity->getFoo();
        }
        return $this->render(
            'test.html.twig',
            [
                'utilisateurs' => $utilisateursReels
            ]
        );
    }

}

