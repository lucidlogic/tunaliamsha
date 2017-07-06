<?php

namespace App\Traits;

use App\ApiLog;

trait CanLog
{
    /**
     * @param string $url
     * @param string $text
     * @param $response
     */
    public function log(
        string $url,
        string $text,
        $response
    ) {
        ApiLog::create([
            'url' => $url,
            'text' => $text,
            'response' => $response
        ]);
    }
}
