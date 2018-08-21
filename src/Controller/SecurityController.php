<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription")
     */
    public function inscription(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
        $utilisateur = new Utilisateur();

        $form = $this->createForm(UtilisateurType::class, $utilisateur);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                dump($utilisateur);
                /*
                 * -- encode le mdp à partir de la config encoders pour l'objet
                 * Utilisateur à partir de son mdp en clair reçu du formulaire
                 */
                $password = $passwordEncoder->encodePassword(
                    $utilisateur,
                    $utilisateur->getPlainpassword()
                );

                $utilisateur->setPassword($password);

                $em = $this->getDoctrine()->getManager();

                $em->persist($utilisateur);
                $em->flush();

                $this->addFlash('success', 'Votre compte a été créé');
                return $this->redirectToRoute('app_index_index');
            } else {
                $this->addFlash(
                    'error',
                    'Le formulaire contient encore des erreurs'
                );
            }
        }

        return $this->render(
            'security/inscription.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/connexion")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // traitement du formulaire par Security
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        if (!empty($error)) {
            $this->addFlash('error', 'Identifiants incorrects');
        }

        return $this->render(
            'security/login.html.twig',
            [
                'last_username' => $lastUsername
            ]
        );
    }
}