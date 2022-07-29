@extends('parent')

@section('content')
<h1 class="text-xl font-black mb-5">Tambah Dosen</h1>
<form action="" method="post">
  @csrf
  <div class="flex flex-col justify-between">
    <label for="">Nama</label>
    <input type="text" id="nama_dosen" class="rounded" value="{{ old('nama') }}">

    <label for="">Email</label>
    <input type="email" id="email_dosen" class="rounded" value="{{ old('email') }}">

    <label for="">Alamat</label>
    <div id="map" class="w-full h-[500px] mb-8"></div>
    <div class="flex items-center flex-col sm:flex-row space-x-4 w-full">
      <input type="text" class="rounded flex-auto" name="" id="longitude" name="longitude" placeholder="Longitude" disabled>
    
      <input type="text" class="rounded flex-auto" name="" id="latitude" name="latitude" placeholder="Latitude" disabled>
    </div>

    <label for="">Password</label>
    <input type="password" id="pwd_dosen" class="rounded" value="{{ old('password') }}">

    <button
      class="rounded-full py-2 px-3 uppercase text-xs font-bold cursor-pointer tracking-wider text-green-800 bg-green-200 W-100 mt-5"
      id="store_location">
      Simpan
    </button>
  </div>
</form>
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
  nama = $('#nama_dosen').val();
  email = $('#email_dosen').val();
  password = $('#pwd_dosen').val();

  $.ajax({
    url: '{{ route('Dosen.add') }}',
    method: 'POST',
    data: {
      _token: '{{ csrf_token() }}',
      nama: nama,
      email:email,
      longitude: lng,
      latitude: lat,
      password: password
    },
    success: function (response) {
      window.location.replace("{{route('Dosen')}}");;
    },
    error: function(error) {
      console.log(error);
    }
  })
  });
@endsection