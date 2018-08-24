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


    /**
     * @Route("/rendezvous/{id}", defaults={"id": null}, requirements={"id"="\d+"})
     */
    public function index(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Rdv::class);
        $rdvs = $repository->findAll();

        dump($rdvs);

        $aRdvs = [];

        foreach ($rdvs as $rdv) {
            dump($rdv->getUtilisateur());
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

        dump($aRdvs);

        $form = $this->createForm(RdvType::class, $rdv);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($rdv);
                $em->flush();

                return $this->redirectToRoute('app_rdv_index');
            }
        }

        return $this->render('rdv/index.html.twig', [
            'form' => $form->createView(),
            'rdvs' => json_encode($aRdvs),
        ]);

    }


}
