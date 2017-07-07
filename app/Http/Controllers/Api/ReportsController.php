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
        $data = request()->all();

        $validator = validator(
            $data,
            [
                'text' => 'required|max:255|min:3',
                'listing_id' => 'required',
                'image' => 'url|max:255|min:3',
                'category' => 'required|max:255|min:3',
            ]
        );

        if ($validator->fails()) {
            return [
                'success' => false
            ] + $validator->errors()->toArray();

        }

        return [
                   'success' => true
               ] + $this->reportService->analyse($data);
    }
}
