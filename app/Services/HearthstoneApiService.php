<?php

declare(strict_types = 1);

namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class HearthstoneApiService implements HearthstoneApiInterface
{
    /**
     * @var Client $client
     */
    private $client;
    /**
     * @var string $apiHost
     */
    private $apiHost;

    /**
     * @var string $apiKey
     */
    private $apiKey;

    public function __construct()
    {
        $this->apiHost = env('X_RAPIDAPI_HOST');
        $this->apiKey = env('X_RAPIDAPI_KEY');
        $this->client = new Client(['headers' => [
            'x-rapidapi-host' => $this->apiHost,
            'x-rapidapi-key' => $this->apiKey
        ]]);
    }

    /**
     * @return array
     */
    public function getAllCards(): array
    {
        return json_decode($this->client
                ->request('GET', 'https://' . $this->apiHost . '/cards')
                ->getBody()
                ->getContents(), true);
    }
}
