<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PokerRequest
{
    public function __construct(
        private HttpClientInterface $client,
    ) {}

    public function fetchGitHubInformation(): array
    {
        $response = $this->client->request(
            'GET',
            'https://pokeapi.co/api/v2/characteristic/'
        );
        $content = $response->toArray()['results'];

        $descriptions = []; // Tableau pour stocker les descriptions en français

        foreach ($content as $value) {
            $response = $this->client->request(
                'GET',
                $value['url']
            );
            $detail = $response->toArray(); // Obtenir les détails de la caractéristique

            foreach ($detail['descriptions'] as $description) {
                if ($description['language']['name'] === 'fr') {
                    $descriptions[] = $description['description']; // Ajouter la description au tableau
                }
            }
        }

        return $descriptions; // Retourner le tableau des descriptions
    }

}