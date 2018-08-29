<?php

namespace App\Controller;

use App\Entity\Motif;
use App\Entity\Rdv;
use App\Form\RdvType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RdvController
 * @package App\Controller
 * @Route("/rendezvous")
 */
class RdvController extends AbstractController
{


    /**
     * @Route("/")
     */
    public function index(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Rdv::class);
        $rdvs = $repository->findAll();


        $aRdvs = [];

        foreach ($rdvs as $rdv) {
            $end = clone $rdv->getDateheuredebut();
            $interval = \DateInterval::createFromDateString($rdv->getMotif()->getDuree() . ' minutes');
            $end->add($interval);

            $aRdvs[] = [
                'title'       => $rdv->getMotif()->getActe(),
                'start'       => $rdv->getDateheuredebut()->format(\DateTime::ATOM),
                'end'         => $end->format(\DateTime::ATOM),
                'color'       => $rdv->getMotif()->getCouleur(),
                'description' => (string)$rdv->getUtilisateur(),

            ];
        }


        $rdv = new Rdv();

        $rdv->setUtilisateur($this->getUser());

        $form = $this->createForm(RdvType::class, $rdv);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if($form->isValid()) {
                dump($request->request->get('rdv')['debut']);
                $rdv->setDateheuredebut(new \DateTime($request->request->get('rdv')['debut']));
                $em = $this->getDoctrine()->getManager();
                $em->persist($rdv);
                $em->flush();

                $date = substr($request->request->get('rdv')['debut'], 0, 10);

                $arrayDate = explode("-", $date);

                $date = $arrayDate[2] . "/" . $arrayDate[1] . "/" . $arrayDate[0];

                $heure = substr($request->request->get('rdv')['debut'], 11, 5);


                $this->addFlash('success', "Votre rendez-vous est bien validé pour le " . $date . " à " . $heure);

                return $this->redirectToRoute('app_rdv_index');
            }
        }


        return $this->render('rdv/index.html.twig', [
            'form' => $form->createView(),
            'rdvs' => json_encode($aRdvs),

        ]);
    }

    /**
     * @Route("/newrdv", options = { "expose" = true })
     */
    public function newRdv(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Motif::class);
        $motif = $repo->find($request->query->get('id'));

        dump('id');
        $response = [
            'couleur' => $motif->getCouleur(),
            'duree' => $motif->getDuree(),
            'acte' => $motif->getActe()
        ];

        return new JsonResponse($response);
        dump($response);

    }

    /**
     * @Route("/getstart", options = { "expose" = true })
     */
    public function getStart(Request $request)
    {

        $response = [
            'start' => $request->query->get('start'),
        ];

        return new JsonResponse($response);

    }

    /**
     * @Route("/listerdv")
     */
    public function listeRdv()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Rdv::class);
        $rdvs = $repository->findAll();

        return $this->render(
            'admin/rendezvous/gestionrdv.html.twig',
            [
                'rdvs' => $rdvs
            ]
        );
    }

    /**
     * @Route("/suppression/{id}")
     */
    public function delete(Rdv $rdv)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($rdv);
        $em->flush();

        $this->addFlash(
            'success',
            'Le rendez-vous est supprimé'
        );

        return $this->redirectToRoute('app_rdv_listerdv');
    }



}
