@extends('parent')

@section('content')
@foreach($tugas as $t)
<span class="text-2xl font-black">{{ $t->name }}</span>
@foreach($scores as $s)
<span class="ml-2">{{$scores->isEmpty()? '0' : $s->score}}/100</span>
@endforeach
<br>
<span class="text-lg">{{$t->user->name}}</span>
<span class="mx-2">|</span>
<span class="text-xs font-hairline">Due : {{ $t->due }}</span>

<p class="text-md my-5">
  {{ $t->description }}
</p>


<form action="{{ url('submitTugas/'.$t->id)}}" method="post">
  @csrf
  <input type="submit" value="Submit" {{$scores->isEmpty()? '' : 'disabled'}} class="rounded-full py-2 px-3 uppercase
  text-xs font-bold cursor-pointer tracking-wider text-green-800 bg-green-200 disabled:text-gray-800
  disabled:bg-gray-200">
  @if(!$scores->isEmpty())
  <span class="font-thin text-green-800">Tugas sudah dikumpulkan</span>
  @endif
</form>
@endforeach
@endsection