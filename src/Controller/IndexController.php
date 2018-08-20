<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('index/index.html.twig');
    }
    /**
     * @Route("/cabinet")
     */
    public function cabinet()
    {
        return $this->render('index/cabinet.html.twig');
    }

    /**
     * @Route("/sante")
     */
    public function sante()
    {
        return $this->render('index/sante.html.twig');
    }
}