<?php

namespace App\Services\Watson;

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
        try{
            $response = $this
                ->client
                ->send(
                    new Request(
                        'GET',
                        config('watson.nlp.url') . '?text=' . $text . '&version=' . config('watson.nlp.version'),
                        [
                            'Authorization' => 'Basic ' . base64_encode(config('watson.nlp.username') . ':' . config('watson.nlp.password')),
                            'Content-Type' => 'application/json',
                        ]
                    )
                );
            return $this->transform($response);
        } catch (\Exception $exception) {
            \Log::error($exception);
        }
    }

    /**
     * @param string $text
     *
     * @return \stdClass
     */
    public function personality(string $text)
    {
        $response = $this
            ->client
            ->send(
                new Request(
                    'POST',
                    config('watson.personality.url') . '?version=' . config('watson.personality.version') . '&consumption_preferences=true&raw_scores=true',
                    [
                        'Authorization' => 'Basic ' . base64_encode(config('watson.personality.username') . ':' . config('watson.personality.password')),
                        'Content-Type' => 'text/plain',
                    ],
                    $text
                )
            );

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
