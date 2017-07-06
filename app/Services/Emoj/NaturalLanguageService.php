<?php

namespace App\Services\Emoj;

use App\Services\Contracts\NaturalLanguageService as Contract;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class NaturalLanguageService implements Contract
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $text
     *
     * @return \stdClass
     */
    public function analyse(string $text)
    {
        $response = $this
            ->client
            ->send(new Request('GET', config('emoj.url') . $text));
        return $this->transform($response);
    }

    /**
     * @param $response
     *
     * @return \stdClass
     */
    protected function transform($response): \stdClass
    {
        return json_decode($response->getBody()->getContents());
    }
}
