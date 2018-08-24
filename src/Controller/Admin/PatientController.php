<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
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


        foreach ($patients as $patient ){

            if(!is_null($patient->getDateNaissance())) {

                $anneePatient = $patient->getDateNaissance()->format('Y');

                $now = new \DateTime();

                $anneeNow = $now->format('Y');

                $age = intval($anneeNow) - intval($anneePatient);

                $age = $age . ' ans';

                $patient->setAge($age);

            }

        }


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


        return $this->render(
            'admin/patient/infos.html.twig',
            [
                'patient' => $patient
            ]
        );
    }

    /**
     * @Route("/recherche", options = { "expose" = true })
     */
    public function recherchePatient()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Utilisateur::class);


/*
        $patients = $repository->findByNameLike($_GET['str']);

        foreach ($patients as $patient) {
            echo $patient . '|';
        }


*/


        return $this->render('admin/patient/recherchePatient.html.twig',
            [

            ]

            );

    }

}

