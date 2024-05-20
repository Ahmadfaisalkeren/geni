<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\SeriesService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Series\StoreSeriesRequest;
use App\Http\Requests\Series\UpdateSeriesRequest;

class SeriesController extends Controller
{
    protected $seriesService;

    public function __construct(SeriesService $seriesService)
    {
        $this->seriesService = $seriesService;
    }

    public function index()
    {
        $series = $this->seriesService->getSeries();

        return response()->json([
            'status' => 200,
            'message' => "Series Data Fetched Successfully",
            'series' => $series,
        ], 200);
    }

    public function publishedSeries()
    {
        $series = $this->seriesService->publishedSeries();

        return response()->json([
            'status' => 200,
            'message' => "Series Data Fetched Successfully",
            'series' => $series
        ], 200);
    }

    public function store(StoreSeriesRequest $request)
    {
        $series = $this->seriesService->storeSeries($request->validated());

        return response()->json([
            'status' => 200,
            'message' => 'Series Stored Successfully',
            'series' => $series,
        ], 200);
    }

    public function edit(string $seriesId)
    {
        $series = $this->seriesService->getSeriesById($seriesId);

        return response()->json([
            'status' => 200,
            'message' => 'Series Fetched Successfully',
            'series' => $series,
        ], 200);
    }

    public function update(string $seriesId, UpdateSeriesRequest $request)
    {
        $series = $this->seriesService->updateSeries($seriesId, $request->validated());

        return response()->json([
            'status' => 200,
            'message' => 'Series Updated Successfully',
            'series' => $series,
        ], 200);
    }

    public function destroy(string $seriesId)
    {
        $series = $this->seriesService->deleteSeries($seriesId);

        return response()->json([
            'status' => 200,
            'message' => 'Series Deleted Successfully',
            'series' => $series,
        ], 200);
    }
}
