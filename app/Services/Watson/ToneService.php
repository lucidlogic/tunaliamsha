<?php

namespace App\Services\Watson;

use App\Services\Contracts\Tone as Contract;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use App\Traits\CanLog;

class ToneService implements Contract
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
     * @return array
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

            return $this->transform($response);
        } catch (\Exception $exception) {

            \Log::error($exception);

            return [
                'score' => null,
                'message' => 'tone problem'
            ];
        }
    }

    /**
     * @param $response
     *
     * @return array
     */
    protected function transform($response): array
    {
        $result =  json_decode($response);

        list($score, $message) = $this->scoreMessage($result);

        return [
            'score' => $score,
            'message' => $message,
        ];
    }

    /**
     * @param $response
     *
     * @return array
     */
    protected function scoreMessage($response)
    {
        list($anger, $disgust, $fear, $joy, $sadness) = $response->document_tone->tone_categories[0]->tones;

        $score = 1;
        $messages = ['Tone is good :).'];

        if ($anger->score > 0.5) {
            $score -= 0.25;
            $message[] = 'Too angry';
        }

        if ($disgust->score > 0.5) {
            $score -= 0.25;
            $message[] = 'Too much disgust';
        }

        if ($fear->score > 0.5) {
            $score -= 0.25;
            $message[] = 'Too much fear';
        }

        if ($sadness->score > 0.5) {
            $score -= 0.25;
            $message[] = 'Too much sadness';
        }

        if ($joy->score < 0.4) {
            $score -= 0.25;
            $message[] = 'Not enough joy.';
        }

        return [
            $score,
            implode(', ', $messages),
        ];
    }
}
