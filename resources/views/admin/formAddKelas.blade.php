@extends('parent')

@section('content')
<h1 class="text-xl font-black mb-5">Tambah Kelas</h1>
<form action="" method="post">
  @csrf
  <div class="flex flex-col justify-between">
    <label for="">Kode Kelas</label>
    <input type="text" name="kode_kelas" class="rounded" value="{{ old('kode_kelas') }}">

    <input type="submit" value="Simpan"
      class="rounded-full py-2 px-3 uppercase text-xs font-bold cursor-pointer tracking-wider text-green-800 bg-green-200 W-100 mt-5">
  </div>
</form>
@endsection