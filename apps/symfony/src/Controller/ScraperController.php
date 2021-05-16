<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/scraper")
 */
class ScraperController extends AbstractController
{
    /**
     * @Route("/fighters", name="app_get_fighters")
     */
    public function getFighters(Request $request): Response
    {
        $content = json_encode([
            'result' => 'ok'
        ]);

        return new Response($content, Response::HTTP_OK, ['content-type' => 'application/json']);
    }


    /**
     * @Route("/stages", name="app_get_stages")
     */
    public function getStages(Request $request): Response
    {
        return new Response();
    }
}