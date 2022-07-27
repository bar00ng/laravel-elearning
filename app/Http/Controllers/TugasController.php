<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Classes;
use App\Models\Score;
use App\Models\Task;

class TugasController extends Controller
{
    public function listTugas(){
        $task = Task::where('user_id',Auth::user()->id)->get();

        return view('dosen.listTugas',['tasks' => $task]);
    }

    public function formAdd(){
        $kelas = Classes::get();
        return view('dosen.formAddTugas',[
            'kelas' => $kelas
        ]);
    }

    public function simpanDataTugas(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'due' => 'required',
            'class_id' => 'required',
        ]);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'due' => $request->due,
            'class_id' => $request->class_id,
            'user_id' => Auth::user()->id,
            'status' => 1
        ]);

        return redirect('Tugas')->with('status','Data berhasil ditambahkan');
    }

    public function hapusDataTugas($id){
        Task::where('id',$id)->delete();

        return redirect('Tugas')->with('status','Data berhasil dihapus');
    }

    public function formEdit($id){
        $tugas = Task::where('id', $id)->get();
        $kelas = Classes::get();

        return view('dosen.formEditTugas',[
            'tugas'=>$tugas,
            'kelas'=>$kelas
        ]);
    }

    public function simpanEditTugas(Request $request, $id){
        $tugas = Task::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'due' => $request->due,
                    'class_id' => $request->class_id,
                    'user_id' => Auth::user()->id 
                ]);
        
                return redirect('Tugas')->with('status','Data berhasil diupdate');
    }

    public function detailTugas($id){
        $tugas = Task::where('id',$id)->get();
        $score = Score::where('task_id',$id)->get();

        return view('dosen.detailTugas',[
            'tugas' => $tugas,
            'score' => $score
        ]);
    }

    public function storeNilai(Request $r, $TugasId, $ScoreId){
        $score = Score::where('id',$ScoreId)
                        ->update([
                            'score' => $r->input('score_'.$ScoreId),
                            'reviewed' => '1'
                        ]);

        return redirect('Tugas/detail/'.$TugasId);
    }
}
