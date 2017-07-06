<?php


use App\Services\Watson\ToneService;
use App\Services\Contracts\Tone as ToneContract;

// Services
App::bind(ToneContract::class, ToneService::class);
