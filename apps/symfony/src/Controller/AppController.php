<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_index", methods={"GET","HEAD"})
     */
    public function index(): Response
    {
        return new Response(
            "<h1>Bienvenue sur l'API Symfony DFWITB.</h1>", 
            Response::HTTP_OK, 
            ["Content-type" => "text/html"]
        );
    }
}