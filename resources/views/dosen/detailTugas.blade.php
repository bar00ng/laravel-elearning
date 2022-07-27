@extends('parent')

@section('content')
@foreach($tugas as $t)
<span class="text-2xl font-black">{{ $t->name }}</span>
<br>
<span class="text-lg">{{$t->user->name}}</span>
<span class="mx-2">|</span>
<span class="text-xs font-hairline">Due : {{ $t->due }}</span>

<p class="text-md my-5">
  {{ $t->description }}
</p>
<div class="w-full mt-5">
  <table class="m-auto">
    <thead class="bg-gray-50 border-b-2 border-gray-200">
      <tr>
        <th class="p-3 text-sm font-semibold tracking-wide">#</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-left">Nama Pengumpul</th>
        <th class="p-3 text-sm font-semibold tracking-wide text-center w-36">Nilai</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
      @php
      $no = 1
      @endphp
      <h1 class="text-2xl font-black mt-10">Daftar yang sudah mengumpulkan</h1>
      @foreach ($score as $s)
      <tr class="odd:bg-white even:bg-gray-50">
        <td class="font-bold text-blue-500 text-center"> {{$no++}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"> {{$s->user->name}}</td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap text-center">
          @if($s->reviewed == 0)
          <form action="{{ url('Tugas/store/'.$t->id.'/'.$s->id) }}" method="post">
            @method('patch')
            @csrf
            <input type="number" class="rounded w-20" name="score_{{ $s->id }}" id="" value="{{$s->score}}" max="100">
            <input type="submit" value="Nilai"
              class="rounded-full py-2 px-3 uppercase text-xs font-bold cursor-pointer tracking-wider text-green-800 bg-green-200 ml-5">
          </form>
          @elseif($s->reviewed == 1)
          {{$s->score}}
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endforeach
@endsection