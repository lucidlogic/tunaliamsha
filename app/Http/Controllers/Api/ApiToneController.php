<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\NaturalLanguageService as NaturalLanguageServiceContract;

class ApiToneController extends Controller
{

   public function show()
   {
       dd(app(NaturalLanguageServiceContract::class)->analyse('I love pizza'));
   }
}
