@extends('parent')

@section('content')
<h1 class="text-xl font-black mb-5">Tambah Tugas</h1>
<form action="" method="post">
  @csrf
  <div class="flex flex-col justify-between">
    <label for="">Judul Tugas</label>
    <input type="text" name="name" class="rounded" value="{{ old('judul_tugas') }}">

    <label for="">Deskripsi Tugas</label>
    <textarea class="rounded" name="description"></textarea>

    <label for="">Batas Pengumpulan</label>
    <input type="date" name="due" class="rounded" value="{{ old('due') }}">

    <label for="">Diberikan Kepada</label>
    <select class="rounded" name="class_id">
      @foreach($kelas as $k)
      <option value="{{ $k->id }}" {{ old('kelas_id')==$k->id ? ' selected' : ' ' }}>
        {{ $k->kd_kelas }}
      </option>
      @endforeach
    </select>

    <input type="submit" value="Simpan"
      class="rounded-full py-2 px-3 uppercase text-xs font-bold cursor-pointer tracking-wider text-green-800 bg-green-200 W-100 mt-5">
  </div>
</form>
@endsection