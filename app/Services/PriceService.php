<?php

namespace App\Services;

use App\Report;
use App\Services\Contracts\Tone as ToneContract;

class PriceService
{

    /**
     * @param array $data
     *
     * @return array
     */
    public function analyse(array $data): array
    {
        $category = $this->category(array_get($data, 'category'));

        if (
            !key_exists($category, config('prices'))
            || !$price = array_get($data, 'price')
        ) {

            return [
                'score' => null,
                 'message' => 'not enough data.',
            ];
        }

        $range = config("prices.$category");

        $score = 0;
        $message = 'price out of range';

        if ($price >= $range[0]){
            $score += 0.5;
            $message = 'price is too high';
        }

        if ($price <= $range[1]){
            $score += 0.5;
            $message = 'price is too low';
        }

        if ($score == 1) {
            $message = 'price is appropriate';
        }

        return [
            'score' => $score,
            'message' =>  $message,
        ];
    }

    /**
     * @param string $category
     *
     * @return string
     */
    protected function category(string $category)
    {
        $category = str_slug($category);

        if (!key_exists($category, config('prices'))) {
            $category = str_plural($category);
        }

        if (!key_exists($category, config('prices'))) {
            $category = str_singular($category);
        }

        return $category;
    }
}
