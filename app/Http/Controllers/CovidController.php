<?php

namespace App\Http\Controllers;

use App\Charts\CovidChart;
use Illuminate\Support\Facades\Http; //Required
use Illuminate\Http\Request;

class CovidController extends Controller
{
    public function index() {
        $data = collect(Http::get('https://data.covid19.go.id/public/api/prov.json')->json());

        
        $chart = new CovidChart;
        
        // dump($labels);

        return view('covid.listData',[
            'data' => $data,
            'chart' => $chart
        ]);
    }
}
