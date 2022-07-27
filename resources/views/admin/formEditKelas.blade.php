@extends('parent')

@section('content')
<h1 class="text-xl font-black mb-5">Edit Kelas</h1>
<form action="" method="post">
  @method('patch')
  @csrf
  @foreach($user as $u)
  <div class="flex flex-col justify-between">
    <label for="">Kode Kelas</label>
    <input type="text" name="kode_kelas" class="rounded" value="{{ $u->kd_kelas }}">

    <input type="submit" value="Simpan"
      class="rounded-full py-2 px-3 uppercase text-xs font-bold cursor-pointer tracking-wider text-green-800 bg-green-200 W-100 mt-5">
  </div>
  @endforeach
</form>
@endsection