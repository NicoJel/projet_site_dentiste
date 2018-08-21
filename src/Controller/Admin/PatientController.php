<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
}
