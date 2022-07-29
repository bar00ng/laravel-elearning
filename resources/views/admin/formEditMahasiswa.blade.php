@extends('parent')

@section('content')
<h1 class="text-xl font-black mb-5">Edit Mahasiswa</h1>
<form action="" method="post">
  @method('patch')
  @csrf
  <div class="flex flex-col justify-between">

    <label for="">Nama</label>
    <input type="text" id="nama_mahasiswa" class="rounded" value="{{ $user['name'] }}">

    <label for="">Email</label>
    <input type="email" id="email_mahasiswa" class="rounded" value="{{ $user['email'] }}">

    <label for="">Alamat</label>
    <div id="map" class="w-full h-[500px] mb-8"></div>
    <div class="flex items-center flex-col sm:flex-row space-x-4 w-full">
      <input type="text" class="rounded flex-auto" name="" id="longitude" name="longitude" placeholder="Longitude"
        value="{{ $user['longitude'] }}" disabled>

      <input type="text" class="rounded flex-auto" name="" id="latitude" name="latitude" placeholder="Latitude"
        value="{{ $user['latitude'] }}" disabled>
    </div>

    <label for="">Kelas</label>
    <select class="rounded" name="class_id">
      @foreach($kelas as $k)
      <option value="{{ $k->id }}" {{ (old('class_id')==$k->id) ? 'selected' : ' ' }} {{ ($user['class_id'] == $k->id) ?
        'selected' : ' ' }}>
        {{ $k->kd_kelas }}
      </option>
    </select>

    <label for="">Password</label>
    <input type="password" id="pwd_mahasiswa" class="rounded">

    <button
      class="rounded-full py-2 px-3 uppercase text-xs font-bold cursor-pointer tracking-wider text-green-800 bg-green-200 W-100 mt-5"
      id="patch_location">
      Simpan
    </button>
  </div>
  @endforeach
</form>
@endsection

@section('scripts')
const marker = new mapboxgl.Marker();
const longitude = document.querySelector('#longitude');
const latitude = document.querySelector('#latitude');
var lng = {{ $user['longitude'] }};
var lat = {{ $user['latitude'] }};
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
  nama = $('#nama_mahasiswa').val();
  email = $('#email_mahasiswa').val();
  kelas = $('select[name=class_id] option').filter(":selected").val();
  password = $('#pwd_mahasiswa').val();

  $.ajax({
    url: '{{ route('mahasiswa.proses.edit', $user['id']) }}',
    method: 'PATCH',
    data: {
      _token: '{{ csrf_token() }}',
      nama: nama,
      email:email,
      longitude: lng,
      latitude: lat,
      class_id: kelas,
      password: password
    },
    success: function (response) {
      window.location.replace("{{route('Mahasiswa')}}");
      console.log("berhasil");
    },
    error: function(error) {
      console.log("gagal");
      console.log(error);
    }
  })
});
@endsection