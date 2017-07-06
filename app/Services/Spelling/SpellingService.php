<?php

namespace App\Services\Spelling;

class SpellingService
{
    /**
     * @param string $text
     *
     * @return array
     */
    public function analyse(string $text): array
    {


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
