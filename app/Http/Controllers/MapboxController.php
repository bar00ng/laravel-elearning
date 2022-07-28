<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Location;

class MapboxController extends Controller
{
    public function index() {
        $locations = Location::where('user_id',Auth::user()->id)->get();

        return view('mapbox',[
            'locations' => $locations
        ]);
    }

    public function store_location(Request $r){
        $location = Location::create([
            'longitude' => $r->longitude,
            'latitude' => $r->latitude,
            'location_name' => $r->location_name,
            'user_id' => Auth::user()->id
        ]);

        return redirect('mapbox');
    }

    public function remove_location($id) {
        Location::where('id', $id)->delete();

        return redirect('mapbox');
    }

    public function get_location($id) {
        $locations = Location::where('id',$id)->first();

        return view('editMapbox',[
            'location' => $locations
        ]);
    }

    public function edit_location(Request $r, $id) {
        Location::where('id', $id)->update([
            'longitude' => $r->longitude,
            'latitude' => $r->latitude,
            'location_name' => $r->location_name,
            'user_id' => $r->Auth::user()->id
        ]);
    }
}
