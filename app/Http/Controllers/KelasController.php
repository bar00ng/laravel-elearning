<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use Illuminate\Support\Facades\Hash;

class KelasController extends Controller
{
    public function listKelas()
    {
        $user = Classes::all();

        return view('admin.listKelas',['users' => $user]);
    }

    public function formAdd(){
        return view('admin.formAddKelas');
    }

    public function simpanDataKelas(Request $r){
        $validated = $r->validate([
            'kode_kelas' => 'required|max:50',
        ]);

        $user = Classes::create([
            'kd_kelas' => $r->kode_kelas
        ]);

        return redirect('Kelas')->with('status','Data berhasil ditambahkan');
    }

    public function hapusDataKelas($id){
        Classes::where('id',$id)->delete();

        return redirect('Kelas')->with('status','Data berhasil dihapus');
    }

    public function formEdit($id){
        $user = Classes::where('id', $id)->get();

        return view('admin.formEditKelas',[
            'user'=>$user,
        ]);
    }

    public function simpanEditKelas(Request $r, $id){
        $user = Classes::where('id', $id)
                ->update([
                    'kd_kelas' => $r->kode_kelas,
                ]);
        
                return redirect('Kelas')->with('status','Data berhasil diupdate');
    }
}
