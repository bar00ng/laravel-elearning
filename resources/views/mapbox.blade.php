@extends('parent')

@section('content')
<div id="map" class="w-full h-[500px] mb-8"></div>

<form>
  {{-- Longitude --}}
  <div class="mb-4">
    <input
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      id="longitude" type="text" placeholder="Longitude" name="longitude" value="{{  old('longitude') }}" disabled
      required>
  </div>
  {{-- Latitude --}}
  <div class="mb-4">
    <input
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      id="latitude" type="text" placeholder="Latitude" name="latitude" value="{{ old('latitude') }}" disabled required>
  </div>
  {{-- Custom Location Name --}}
  <div class="mb-4">
    <input
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      id="location_name" type="text" placeholder="Custom Name" name="location_name" value="{{ old('location_name') }}"
      required>
  </div>
  {{-- Button --}}
  <div class="mb-4">

    <button
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full"
      id="store_location">
      Save Location
    </button>
  </div>
</form>

<div class="flex items-center justify-center">
  <h1 class="text-xl font-black">Daftar Lokasi Tersimpan</h1>
</div>

@php
$no = 1
@endphp
@if($locations->isEmpty())
<p class="text-center my-10"><i>Data table is empty</i></p>
@else
<div class="overflow-auto rounded-lg shadow mt-5">
  <table class="w-full">
    <thead class="bg-gray-50 border-b-2 border-gray-200">
      <tr>
        <th class="p-3 text-sm font-semibold tracking-wide">#</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-left">Location Name</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-left">Longitude</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-left">Latitude</th>
        <th class="p-3 text-sm font-semibold tracking-wide w-28">Option</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
      @foreach ($locations as $location)
      <tr class="odd:bg-white even:bg-gray-50">
        <td class="font-bold text-blue-500 text-center"> {{$no++}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"> {{$location->location_name}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"> {{$location->longitude}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"> {{$location->latitude}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
          <div class="text-center flex items-center">
            <a href="{{route('mapbox.get.loc',$location->id)}}"
              class="rounded-full py-2 px-3 uppercase text-xs font-bold cursor-pointer tracking-wider text-yellow-800 bg-yellow-200 mr-3">Edit</a>
            <form action="{{route('del.loc',$location->id)}}" method="post">
              @method('delete')
              @csrf
              <button
                class="rounded-full py-2 px-3 uppercase text-xs font-bold cursor-pointer tracking-wider text-red-800 bg-red-200">Hapus</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endif
@endsection

@section('scripts')
const marker = new mapboxgl.Marker();
const longitude = document.querySelector('#longitude');
const latitude = document.querySelector('#latitude');
var lng = 107.615299, lat = -6.8868957;
function coordinateFeature(lng, lat) {
return {
center: [lng, lat],
geometry: {
type: 'Point',
coordinates: [lng, lat]
},
place_name: 'Lat: ' + lat + ' Lng: ' + lng,
place_type: ['coordinate'],
properties: {},
type: 'Feature'
};
}
function add_marker (e) {
var coordinates = e.lngLat;
console.log('Lng:', coordinates.lng, 'Lat:', coordinates.lat);
marker.setLngLat(coordinates).addTo(map);
longitude.value = coordinates.lng;
latitude.value = coordinates.lat;
lng = coordinates.lng;
lat = coordinates.lat;
}
mapboxgl.accessToken =
"pk.eyJ1Ijoic3l1a3VyemFreSIsImEiOiJjbDVoanF2a2QwYTU3M2NtZDRjc3BiaGdyIn0.bDzvwmyRWBKYqF1M9Hxkkw";
const map = new mapboxgl.Map({
container: "map", // container ID
style: "mapbox://styles/mapbox/streets-v11", // style URL
center: [lng, lat], // starting position [lng, lat]
zoom: 15, // starting zoom
projection: "globe", // display the map as a 3D globe
});
map.on("style.load", () => {
map.setFog({});
});
map.on('click', add_marker.bind(this));
map.addControl(
new mapboxgl.GeolocateControl({
positionOptions: {
enableHighAccuracy: true
},
trackUserLocation: true,
showUserHeading: true
})
);

// Simpan Data Lokasi
$("#store_location").click(function (e) {
e.preventDefault();
location_name = $('#location_name').val();
console.log(lng+' '+lat+' '+location_name);
$.ajax({
url: '{{ route('store.loc') }}',
method: 'POST',
data: {
_token: '{{ csrf_token() }}',
longitude: lng,
latitude: lat,
location_name: location_name
},
success: function (response) {
window.location.reload();
},
error: function(error) {
console.log(error);
}
})
});
@endsection