<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Tone as ToneContract;
use App\Services\ReportService;

class ReportsController extends Controller
{
    /**
     * @var ReportService
     */
    protected $reportService;

    /**
     * @param ReportService $reportService
     */
    public function __construct(
        ReportService $reportService
    ) {
        $this->reportService = $reportService;
    }

    /**
     * @return array
     */
    public function show()
    {
        $validator = validator(
            request()->all(),
            [
                'text' => 'required|max:255|min:3',
                'image' => 'url|max:255|min:3',
                'category' => 'required|max:255|min:3',
                'price' => 'number',
            ]
        );

        if ($validator->fails()) {

            return [
                'success' => false
            ] + $validator->errors()->toArray();

        }
        dd(auth()->user());
        dd(app(ToneContract::class)->analyse('this fridge sucks'));
    }
}
