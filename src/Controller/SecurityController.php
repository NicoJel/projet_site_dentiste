<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
                /**
                 * -- encode le mdp à partir de la config encoders pour l'objet
                 * Utilisateur à partir de son mdp en clair reçu du formulaire
                 */
                $password = $passwordEncoder->encodePassword(
                    $utilisateur,
                    $utilisateur->getPlainpassword()
                );

                $utilisateur->setPassword($password);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Votre compte est créé');
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
}