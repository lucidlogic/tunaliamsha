<?php

namespace App\Services\Contracts;

interface NaturalLanguageService
{
    /**
     * @param string $text
     *
     * @return mixed
     */
    public function analyse(string $text);
}
