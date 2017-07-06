<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\NaturalLanguageService as NaturalLanguageContract;

class ApiToneController extends Controller
{

   public function show()
   {
       dd(app(NaturalLanguageContract::class)->analyse('Electric four burner cooker on sale. Good working condition.'));
   }
}
