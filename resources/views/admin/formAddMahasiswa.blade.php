@extends('parent')

@section('content')
<h1 class="text-xl font-black mb-5">Tambah Mahasiswa</h1>
<form action="" method="post">
  @csrf
  <div class="flex flex-col justify-between">
    <label for="">Nama</label>
    <input type="text" name="nama" class="rounded" value="{{ old('nama') }}">

    <label for="">Email</label>
    <input type="email" name="email" class="rounded" value="{{ old('email') }}">

    <label for="">Alamat</label>
    <input type="text" name="alamat" class="rounded" value="{{ old('alamat') }}">

    <label for="">Kelas</label>
    <select class="rounded" name="class_id">
      @foreach($kelas as $k)
      <option value="{{ $k->id }}" {{ old('kelas_id')==$k->id ? ' selected' : ' ' }}>
        {{ $k->kd_kelas }}
      </option>
      @endforeach
    </select>

    <label for="">Password</label>
    <input type="password" name="password" class="rounded" value="{{ old('password') }}">

    <input type="submit" value="Simpan"
      class="rounded-full py-2 px-3 uppercase text-xs font-bold cursor-pointer tracking-wider text-green-800 bg-green-200 W-100 mt-5">
  </div>
</form>
@endsection