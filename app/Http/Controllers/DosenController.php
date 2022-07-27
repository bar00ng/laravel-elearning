<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function listDosen()
    {
        $user = User::whereRoleIs('dosen')->get();

        return view('admin.listDosen',['users' => $user]);
    }

    public function formAdd(){
        return view('admin.formAddDosen');
    }

    public function simpanDataDosen(Request $r){
        $validated = $r->validate([
            'nama' => 'required|max:50',
            'email' => 'required|max:50|unique:App\Models\User,email',
            'alamat' => 'required|max:255',
            'password' => 'required|max:50'
        ]);

        $user = User::create([
            'name' => $r->nama,
            'email' => $r->email,
            'alamat' => $r->alamat,
            'password' => Hash::make($r->password),
            'class_id' => '0'
        ]);

        $user->attachRole('dosen');

        return redirect('Dosen')->with('status','Data berhasil ditambahkan');
    }

    public function hapusDataDosen($id){
        User::where('id',$id)->delete();
        DB::table('role_user')->where('user_id',$id)->delete();

        return redirect('Dosen')->with('status','Data berhasil dihapus');
    }

    public function formEdit($id){
        $user = User::where('id', $id)->get();

        return view('admin.formEditDosen',[
            'user'=>$user,
        ]);
    }

    public function simpanEditDosen(Request $r, $id){
        $user = User::where('id', $id)
                ->update([
                    'name' => $r->nama,
                    'email' => $r->email,
                    'alamat' => $r->alamat,
                    'password' => Hash::make($r->password)
                ]);
        
                return redirect('Dosen')->with('status','Data berhasil diupdate');
    }
}
