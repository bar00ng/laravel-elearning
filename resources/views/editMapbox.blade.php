@extends('parent')

@section('content')
<div id="map" class="w-full h-[500px] mb-8"></div>

<form>
  {{-- Longitude --}}
  <div class="mb-4">
    <input
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      id="longitude" type="text" placeholder="Longitude" name="longitude" value="{{ $location['longitude'] }}" disabled
      required>
  </div>
  {{-- Latitude --}}
  <div class="mb-4">
    <input
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      id="latitude" type="text" placeholder="Latitude" name="latitude" value="{{ $location['latitude'] }}" disabled required>
  </div>
  {{-- Custom Location Name --}}
  <div class="mb-4">
    <input
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      id="location_name" type="text" placeholder="Custom Name" name="location_name" value="{{ $location['location_name'] }}"
      required>
  </div>
  {{-- Button --}}
  <div class="mb-4">

    <button
      class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full"
      id="store_location">
      Edit Location
    </button>
  </div>
</form>
@endsection

@section('scripts')
const marker = new mapboxgl.Marker();
const longitude = document.querySelector('#longitude');
const latitude = document.querySelector('#latitude');
var lng = {{ $location['longitude'] }};
var lat = {{ $location['latitude'] }};
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
const default_marker = marker.setLngLat([lng, lat]).addTo(map);
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
$("#patch_location").click(function (e) {
e.preventDefault();
location_name = $('#location_name').val();
console.log(lng+' '+lat+' '+location_name);
$.ajax({
url: '{{ route('edit.loc', $location['id']) }}',
method: 'PATCH',
data: {
_token: '{{ csrf_token() }}',
longitude: lng,
latitude: lat,
location_name: location_name
},
success: function (response) {
window.location.replace("{{route('mapbox')}}");
console.log("berhasil");
},
error: function(error) {
console.log("gagal");
console.log(error);
}
})
});
@endsection