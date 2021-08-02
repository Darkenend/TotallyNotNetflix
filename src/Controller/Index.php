<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Index extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function indexPage(): Response
    {
        return $this->render('index/index.html.twig');
    }
}