<?php


use App\Services\Contracts\NaturalLanguageService as NaturalLanguageServiceContract;
use App\Services\Watson\NaturalLanguageService as WatsonService;
use App\Services\Emoj\NaturalLanguageService as EmojiService;

// Services
App::bind(NaturalLanguageServiceContract::class, EmojiService::class);
