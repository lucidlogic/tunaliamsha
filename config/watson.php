<?php

return [

    'nlp' => [
        'url' => 'https://gateway.watsonplatform.net/natural-language-understanding/api/v1/analyze',
        'features' => [
            'entities' => [
                'emotion' => true,
                'sentiment' => true,
            ],
            'keywords' => [
                'emotion' => true,
                'sentiment' => true,
            ],
            'categories' => [
                'emotion' => true,
                'sentiment' => true,
            ],
            'concepts' => [
                'emotion' => true,
                'sentiment' => true,
            ],
        ],
        'version' => '2017-02-27',
        'username' => '8bdf9c11-0f56-4281-a740-4c933133e7f0',
        'password' => 'pkjubWi66h8L',
    ],
    'personality' => [
        'url' => 'https://gateway.watsonplatform.net/personality-insights/api/v3/profile',
        'version' => '2016-10-20',
        'consumption_preferences' => true,
        'raw_scores' => true,
        'username' => 'd1c5c34e-6058-4a5d-9c79-5c4e8ebc6961',
        'password' => 'viLCXq7cnge3',
    ],
    'keyword' => [
        'relevance' => 0.7,
    ],


];
