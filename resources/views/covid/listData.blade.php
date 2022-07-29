@extends('parent')

@section('content')
<div class="flex items-center justify-between">
  <h1 class="text-xl font-black">Data Covid-19 Per Provinsi</h1>
  <p>{{$data['last_date']}}</p>
</div>

<div id="chart" style="height: 300px;"></div>

@php
$no = 1
@endphp
<div class="overflow-auto rounded-lg shadow mt-2">
  <table class="w-full">
    <thead class="bg-gray-50 border-b-2 border-gray-200">
      <tr>
        <th class="p-3 text-sm font-semibold tracking-wide">#</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-left">Provinsi</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-left">Jumlah Kasus</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-left">Jumlah Sembuh</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-left">Jumlah Meninggal</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-left">Jumlah Dirawat</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
      @foreach ($data['list_data'] as $d)
      <tr class="odd:bg-white even:bg-gray-50">
        <td class="font-bold text-blue-500 text-center"> {{$no++}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"> {{$d['key']}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"> {{number_format($d['jumlah_kasus'])}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"> {{number_format($d['jumlah_sembuh'])}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"> {{number_format($d['jumlah_meninggal'])}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"> {{number_format($d['jumlah_dirawat'])}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Charting library -->
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
<!-- Your application script -->
<script>
  const chart = new Chartisan({
        el: '#chart',
        url: "@chart('covid_chart')",
        hooks: new ChartisanHooks()
        .colors()
        .tooltip(),
      });
</script>
@endsection