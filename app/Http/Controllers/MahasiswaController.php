<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function listMahasiswa()
    {
        $user = User::whereRoleIs('mahasiswa')->get();

        return view('admin.listMahasiswa',['users' => $user]);
    }

    public function formAdd(){
        $kelas = Classes::all();

        return view('admin.formAddMahasiswa',['kelas' => $kelas]);
    }

    public function simpanDataMahasiswa(Request $r){
        $validated = $r->validate([
            'nama' => 'required|max:50',
            'email' => 'required|max:50|unique:App\Models\User,email',
            'class_id' =>'required|max:50|',
            'password' => 'required|max:50'
        ]);

        $user = User::create([
            'name' => $r->nama,
            'email' => $r->email,
            'longitude' => $r->longitude,
            'latitude' => $r->latitude,
            'class_id' => $r->class_id,
            'password' => Hash::make($r->password)
        ]);

        $user->attachRole('mahasiswa');

        return redirect('Mahasiswa')->with('status','Data berhasil ditambahkan');
    }

    public function hapusDataMahasiswa($id){
        DB::table('users')->where('id',$id)->delete();
        DB::table('role_user')->where('user_id',$id)->delete();

        return redirect('Mahasiswa')->with('status','Data berhasil dihapus');
    }

    public function formEdit($id){
        $user = User::where('id', $id)->first();
        $kelas = Classes::get();

        return view('admin.formEditMahasiswa',[
            'user'=>$user,
            'kelas'=>$kelas
        ]);
    }

    public function simpanEditMahasiswa(Request $r, $id){
        $user = User::where('id', $id)
                ->update([
                    'name' => $r->nama,
                    'email' => $r->email,
                    'longitude' => $r->longitude,
                    'latitude' => $r->latitude,
                    'class_id' => $r->class_id,
                    'password' => Hash::make($r->password)
                ]);
    }
}
