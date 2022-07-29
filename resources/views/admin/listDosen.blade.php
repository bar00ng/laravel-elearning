@extends('parent')

@section('content')
<div class="flex items-center justify-between">
  <h1 class="text-xl font-black">Daftar Dosen</h1>
  <a class="rounded-full py-2 px-3 uppercase text-xs font-bold cursor-pointer tracking-wider text-cyan-800 bg-cyan-200"
    href="Dosen/add">Tambah</a>
</div>
@php
$no = 1
@endphp
@if($users->isEmpty())
<p class="text-center my-10"><i>Data table is empty</i></p>
@else
<div class="overflow-auto rounded-lg shadow mt-5">
  <table class="w-full">
    <thead class="bg-gray-50 border-b-2 border-gray-200">
      <tr>
        <th class="p-3 text-sm font-semibold tracking-wide">#</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-left">Nama</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-left">Email</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-left">Alamat</th>
        <th class="p-3 text-sm font-semibold tracking-wide w-28">Option</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
      @foreach ($users as $user)
      <tr class="odd:bg-white even:bg-gray-50">
        <td class="font-bold text-blue-500 text-center"> {{$no++}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"> {{$user->name}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"> {{$user->email}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
          <p>Lat : {{$user->latitude}}</p>
          <p>Lng : {{$user->longitude}}</p>
        </td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
          <div class="text-center flex items-center">
            <a href="{{ url('Dosen/edit/'.$user->id) }}"
              class="rounded-full py-2 px-3 uppercase text-xs font-bold cursor-pointer tracking-wider text-yellow-800 bg-yellow-200 mr-3">Edit</a>
            <form action="{{ url('Dosen/'.$user->id) }}" method="post">
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