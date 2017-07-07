<?php

namespace App\Services;

use App\Report;
use App\Services\Contracts\Tone as ToneContract;

class ReportService
{
    protected $score;

    /**
     * @var PriceService
     */
    protected $priceService;

    /**
     * @var ToneContract
     */
    protected $toneService;

    /**
     * @param PriceService $priceService
     * @param ToneContract $toneService
     */
    public function __construct(
        PriceService $priceService,
        ToneContract $toneService
    ) {
        $this->priceService = $priceService;
        $this->toneService = $toneService;
    }

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
        ]);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function analyse(array $data): array
    {
        $response = [
            'listing_id' => array_get($data, 'listing_id'),
            'spelling' => $this->spelling($data),
            'pricing' => $this->pricing($data),
            'tone' => $this->tone($data),
            'image' => $this->image($data),
        ];

        $response['score'] = $this->score($response);

        $this->save($response);

        return $response;
    }

    protected function spelling(array $data): array
    {

    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function pricing(array $data): array
    {
        return $this->priceService->analyse($data);
    }

    /**
     * @param array $data
     *
     * @return string
     */
    protected function tone(array $data)
    {
        return $this
            ->toneService
            ->analyse($data['text']);
    }

    protected function image(array $data)
    {

    }

    /**
     * @param array $data
     *
     * @return float
     */
    protected function score(array $data)
    {
        return collect($data)
            ->filter(function ($value, $key) {
                return in_array($key, ['spelling', 'pricing', 'tone', 'image'])
                    && !is_null($value['score']);
            })
            ->avg('score');
    }
}
