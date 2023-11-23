<?php

namespace App\Controller;

use App\Service\PokerRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LookPokerApiController extends AbstractController
{
    #[Route('/', name: 'app_look_star_wars_api')]
    public function index(PokerRequest $starWarsRequest): Response
    {
        return $this->render('look_star_wars_api/index.html.twig', [
            'controller_name' => 'LookPokerApiController',
            'look'=>$starWarsRequest->fetchGitHubInformation()
        ]);
    }
}
