<?php

namespace App\Services\Watson;

use App\Services\Contracts\NaturalLanguageService as Contract;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use App\Traits\CanLog;

class NaturalLanguageService implements Contract
{
    use CanLog;

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
            $url = config('watson.nlp.url') . '?version=' . config('watson.nlp.version');

            $response = $this
                ->client
                ->send(
                    new Request(
                        'GET',
                        $url . '&text=' . $text ,
                        [
                            'Authorization' => 'Basic ' . base64_encode(config('watson.nlp.username') . ':' . config('watson.nlp.password')),
                            'Content-Type' => 'application/json',
                        ]
                    )
                )
                ->getBody()
                ->getContents();

            $this->log($url, $text, $response);

            return  $this->transform($response);
        } catch (\Exception $exception) {
            \Log::error($exception);
        }
    }

    /**
     * @param $response
     *
     * @return \stdClass
     */
    protected function transform($response): \stdClass
    {
        return json_decode($response);
    }
}
