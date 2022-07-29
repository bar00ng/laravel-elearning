<?php

namespace App\Http\Controllers;

use App\Charts\CovidChart;
use Illuminate\Support\Facades\Http; //Required
use Illuminate\Http\Request;

class CovidController extends Controller
{
    public function index() {
        $data = collect(Http::get('https://data.covid19.go.id/public/api/prov.json')->json());

        $list_data = collect(Http::get('https://data.covid19.go.id/public/api/prov.json')->json()['list_data']);

        $labels = $list_data->pluck('key');
        $chart_data = $list_data->pluck('jumlah_kasus');

        $chart = new CovidChart;
        $chart->labels($labels);
        $chart->dataSet('Data Kasus Positif di Indonesia','pie',$chart_data);

        dump($labels);

        return view('covid.listData',[
            'data' => $data,
            'chart' => $chart
        ]);
    }
}
