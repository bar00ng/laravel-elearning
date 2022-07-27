@extends('parent')

@section('content')
<div class="container mx-auto">
  @if($tugas->isEmpty())
  <div class="text-center w-full h-full align-middle">
    <h1 class="text-5xl font-black text-gray-700">Tidak ada tugas</h1>
  </div>
  @else

  <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
    @foreach($tugas as $t)
    <div
      class="text-left p-6 border bg-white border-gray-200 shadow-lg rounded-xl transform transition duration-500 hover:scale-110">
      <h1 class="text-2xl font-black">{{ $t->name }}</h1>
      <span class="text-lg">{{$t->user->name}}</span>

      <p class="text-md my-5">
        {{ $t->description }}
      </p>

      <div class="flex items-center justify-between">
        <span class="text-xs font-hairline">Due : {{ $t->due }}</span>

        <a href="{{ url('detailAssignment/'.$t->id) }}"
          class="flex-inline justfify-end py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Read more
        </a>
      </div>
    </div>
    @endforeach
  </div>
  @endif
</div>
@endsection