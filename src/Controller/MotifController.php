<?php

namespace App\Controller;

use App\Entity\Motif;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MotifController
 * @package App\Controller
 */
class MotifController extends AbstractController
{
    /**
     * @Route("/motif", name="motif")
     */
    public function index()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Motif::class);
        $motifs = $repository->findAll();


        return $this->render('motif/index.html.twig', [
            'motifs' => $motifs,
        ]);
    }

}
