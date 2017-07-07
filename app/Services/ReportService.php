<?php

namespace App\Services;

use App\Report;
use App\Services\Contracts\Tone as ToneContract;
use App\Services\ImageService;

class ReportService
{
    /**
     * @var ToneContract
     */
    protected $toneService;

    /**
     * @var ImageService
     */
    protected $imageService;

    /**
     * @param ToneContract $toneService
     */
    public function __construct(
        ToneContract $toneService
    ) {
        $this->toneService = $toneService;
        $this->imageService = new ImageService();
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
            'score' => array_get($data, 'score'),
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
            'spelling' => json_encode($this->spelling($data)),
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

    protected function pricing(array $data)
    {

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
        return $this->imageService->analyse($data);
    }

    protected function score(array $data)
    {
        return;
    }
}
