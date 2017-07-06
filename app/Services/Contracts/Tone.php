<?php

namespace App\Services\Contracts;

interface Tone
{
    /**
     * @param string $text
     *
     * @return mixed
     */
    public function analyse(string $text);
}
