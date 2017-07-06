<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\NaturalLanguageService as NaturalLanguageContract;
use App\Services\Spelling\SpellingService;

class ApiToneController extends Controller
{

   public function show()
   {
       dd(pspell_check('sdasdasd'));
   }
}
