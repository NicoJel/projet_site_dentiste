<?php

namespace App\Controller\Admin;

use App\Entity\Motif;
use App\Entity\Rdv;
use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class PatientController
 * @package App\Controller\Admin
 */
class PatientController extends AbstractController
{
    /**
     * @Route("/patient")
     */
    public function index(UserPasswordEncoderInterface $passwordEncoder)
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

        $utilisateur = new Utilisateur();
        $verif = true;

        if (!empty($_POST)){

            if (empty($_POST['prenom'])){
                $this->addFlash('error', 'Le prénom doit être renseigné');
                $verif = false;
            }

            if (empty($_POST['nom'])){
                $this->addFlash('error', 'Le nom doit être renseigné');
                $verif = false;
            }

            if (empty($_POST['email'])){
                $this->addFlash('error', "L'email doit être renseigné");
                $verif = false;
            }

            if (empty($_POST['motDePasse'])){
                $this->addFlash('error', 'Le mot de passe doit être renseigné');
                $verif = false;
            }

            if ($verif){

                $utilisateur->setPrenom($_POST['prenom']);
                $utilisateur->setNom($_POST['nom']);
                $utilisateur->setMail($_POST['email']);
                $utilisateur->setPlainpassword($_POST['motDePasse']);
                $utilisateur->setCommentaire($_POST['remarques']);

                $password = $passwordEncoder->encodePassword(
                    $utilisateur,
                    $utilisateur->getPlainpassword()
                );

                $utilisateur->setPassword($password);

                $em->persist($utilisateur);
                $em->flush();

                $this->addFlash('success', 'Le patient est créé');
                return $this->redirectToRoute('app_admin_patient_index');

            }else{
                $this->addFlash(
                    'error',
                    'Le formulaire contient des erreurs'
                );
            }

        }

        $aujourdhui = new \DateTime();

        return $this->render(
            'admin/patient/index.html.twig',
            [
                'patients'      => $patients,
                'aujourdhui'    => $aujourdhui
            ]
        );
    }

    /**
     * @Route("/patient/{id}")
     */
    public function infos(Utilisateur $patient)
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
                $patient->setPrenom($_POST['prenom']);
                $patient->setNom($_POST['nom']);
                $patient->setTelephone($_POST['telephone']);
                $patient->setAdresse($_POST['adresse']);
                $patient->setVille($_POST['ville']);
                $patient->setDateNaissance($dateNaissance);
                $patient->setCp($_POST['cp']);
                $patient->setCommentaire($_POST['commentaire']);

                $em = $this->getDoctrine()->getManager();

                $em->persist($patient);
                $em->flush();

                $this->addFlash('success', 'Le profil est bien modifié');

                return $this->redirectToRoute('app_admin_patient_index', [
                    'id' => $patient->getId()
                ]);

            }

        }


        return $this->render(
            'admin/patient/infos.html.twig',
            [
                'patient' => $patient,
                'aujourdhui'    => $aujourdhui
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


        if (strlen($_GET['str']) >= 1){
            $patients = $repository->findByNameLike($_GET['str']);
        }else{
            $patients = $repository->findBy([], ['nom' => 'asc']);
        }



        return $this->render('admin/patient/recherchePatient.html.twig',
            [
                'patients' => $patients
            ]

            );

    }

    /**
     * @Route("/supprimer/{id}")
     */
    public function supprimer(Utilisateur $utilisateur){

        if ($utilisateur->getRdv()->isEmpty()){

            $em = $this->getDoctrine()->getManager();
            if (is_null($utilisateur)){
                throw new NotFoundHttpException();
            }

            $em->remove($utilisateur);
            $em->flush();

            $this->addFlash('success', "L'utilisateur est bien supprimé");

        }else{
            $this->addFlash('error', "L'utilisateur ne peut être supprimé car il a encore des rendez-vous");
        }
        return $this->redirectToRoute('app_admin_patient_index');

    }
    /**
     * @Route("/listerdv/{id}", defaults={"id": null}, requirements={"id"="\d+"})
     */
    public function listeRdv (Utilisateur $utilisateur)
    {

        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository(Motif::class);

        $motifs = $repository->findAll();

        $verif = true;

        if (!empty($_POST)){

            if(empty($_POST['date'])){
                $this->addFlash('error', 'La date doit être renseignée');
                $verif = false;
            };
            if(empty($_POST['horaire'])){
                $this->addFlash('error', "L'heure doit être renseignée");
                $verif = false;
            };
            if (empty($_POST['motif'])){
                $this->addFlash('error', "Le motif doit être renseigné");
                $verif = false;
            }

            if ($verif){

                if (!is_null($_POST['idRdv'])){

                    $repository = $em->getRepository(Rdv::class);

                    $rdv = $repository->findOneBy([
                        'id' => $_POST['idRdv']
                    ]);
                }else{

                    $rdv = new Rdv();

                }


                $repository = $em->getRepository(Motif::class);
                $motif = $repository->findOneBy([
                    'acte' => $_POST['motif']
                ]);

                $dateRdv = new \DateTime($_POST['date'] . " " . $_POST['horaire']);

                $rdv->setMotif($motif)
                    ->setUtilisateur($utilisateur)
                    ->setTextelibre($_POST['remarques'])
                    ->setDateheuredebut($dateRdv)
                ;

                $em->persist($rdv);
                $em->flush();

                $this->addFlash('success', 'Le rendez vous est bien enregistré');
                return $this->redirectToRoute('app_admin_patient_listerdv',
                    [
                        'id' => $utilisateur->getId()
                    ]);
            }

        }


        $aujourdhui = new \DateTime();

        $rdvs = $utilisateur->getRdv();

        dump($rdvs);

        return $this->render('admin/patient/listeRdv.html.twig', [
            'rdvs'          => $rdvs,
            'utilisateur'   => $utilisateur,
            'aujourdhui'    => $aujourdhui,
            'motifs'        => $motifs
        ]);

    }


    /**
     * @Route("/actes")
     */
    public function gestionActes()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Motif::class);

        $motifs = $repository->findAll();

        dump($motifs);

        $verif = true;

        if(!empty($_POST)){

            if (empty($_POST['acte'])){
                $this->addFlash('error', "le nom de l'acte doit être renseigné");
                $verif = false;
            }
            if (empty($_POST['duree'])){
                $this->addFlash('error', "la durée doit être renseignée");
                $verif = false;
            }

            dump(intval($_POST['duree']));

            if ($verif){

                $motif = new Motif();
                $motif  ->setActe($_POST['acte'])
                        ->setDuree(intval($_POST['duree']))
                        ->setCouleur($_POST['couleur']);

                $em->persist($motif);
                $em->flush();
                $this->addFlash('success', "l'acte est bien enregistré");
                return $this->redirectToRoute('app_admin_patient_gestionactes');

            }


        }

        return $this->render('admin/actes/gestionActes.html.twig',
            [
                'motifs' => $motifs
            ]);

    }


}

