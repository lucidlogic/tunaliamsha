<?php

namespace App\Services;

use App\Report;

class ReportService
{
    /**
     * @param array $data
     *
     * @return bool
     */
    public function save(array $data): bool
    {
        return Report::create([
            'user_id' => auth()->user()->id,
            'listing_id' => array_get($data, 'listing_id'),
            'spelling' => array_get($data, 'spelling'),
            'pricing' => array_get($data, 'pricing'),
            'tone' => array_get($data, 'tone'),
            'image' => array_get($data, 'image'),
            'score' => array_get($data, 'score'),
        ]);
    }
}
