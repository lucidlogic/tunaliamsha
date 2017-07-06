<?php

return [

    'nlp' => [
        'password' => env('WATSON_PASSWORD'),
        'tones' => 'emotion',
        'url' => 'https://gateway.watsonplatform.net/tone-analyzer/api/v3/tone',
        'username' => env('WATSON_USERNAME'),
        'version' => '2017-02-27',
    ],
];
