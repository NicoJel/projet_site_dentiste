<?php

namespace App\Controller;

use App\Entity\Rdv;
use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RdvController
 * @package App\Controller
 */
class RdvController extends AbstractController
{
    /**
     * @Route("/rendezvous")
     */
    public function index()
    {

        return $this->render('rdv/index.html.twig');
    }

}
