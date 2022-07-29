<?php

declare(strict_types = 1);

namespace App\Charts;

use Illuminate\Support\Facades\Http; //Required
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class CovidChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $list_data = collect(Http::get('https://data.covid19.go.id/public/api/prov.json')->json()['list_data']);

        $labels = $list_data->pluck('key');
        $chart_data = $list_data->pluck('jumlah_kasus');

        return Chartisan::build()
            ->labels($labels->toArray())
            ->dataset('Data Kasus Positif di Indonesia', $chart_data->toArray());
    }
}