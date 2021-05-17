<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\Fighters;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @Route("/scraper")
 */
class ScraperController extends AbstractController
{
    private $httpClient;

    private $entityManager;


    public function __construct(HttpClientInterface $httpClient, EntityManagerInterface $entityManager)
    {
        $this->httpClient = $httpClient;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/refresh/fighters", name="app_refresh_fighters", methods={"GET","HEAD"})
     */
    public function getFighters(Request $request): Response
    {
        $scraperResponse = $this->httpClient->request('GET', $_ENV['SCRAPER_URL']."/scraper/fighters");

        if($scraperResponse->getStatusCode() === 200){
            try{
                foreach(json_decode($scraperResponse->getContent()) as $fighter_data){

                    // Create new fighter entity from scraper's data
                    $fighter = new Fighters();
                    $fighter->setName($fighter_data->name);
                    $fighter->setImg($fighter_data->img_url);
                    $fighter->setIcon($fighter_data->icon_url);
                    $fighter->setPage($fighter_data->page);
    
                    // Test if fighter already exist
                    if(!$this->entityManager->getRepository(Fighters::class)->findOneBy(['name' => $fighter->getName()]))
                        $this->entityManager->persist($fighter);
                }
    
                $this->entityManager->flush();
    
                return new Response(
                    $scraperResponse->getContent(), 
                    Response::HTTP_OK,
                    ["Content-type" => "application/json"]
                );
            }
            catch(Doctrine\ORM\ORMException $exception){
                throw $exception;
            }
        }

        throw new \Exception("Something went wrong with the Node Scraper.");
    }
}