<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Score;
use Illuminate\Http\Request;
use App\Models\Task;

class AssignmentController extends Controller
{
    
    public function listTugas(){
        $tugas = Task::where('class_id',Auth::user()->class->id)->get();

        return view('mahasiswa.listTugas',[
            'tugas' => $tugas
        ]);
    }

    public function detailTugas($id){
        $tugas = Task::where('id',$id)->get();

        $score = Score::where('user_id', Auth::user()->id)
                        ->where('task_id', $id)
                        ->get();

        return view('mahasiswa.detailTugas',[
            'tugas' => $tugas,
            'scores' => $score
        ]);
    }

    public function submitTugas($tugasId){
        $score = Score::where('user_id', Auth::user()->id)
                        ->where('task_id', $tugasId)
                        ->get();

        if($score->isEmpty()){
            Score::create([
                'user_id' => Auth::user()->id,
                'task_id' => $tugasId,
                'score' => 0,
                'reviewed' => 0
            ]);

            return redirect('detailAssignment/'.$tugasId)->with('berhasil','Berhasil mengumpulkan');
        }else{
            return redirect('detailAssignment/'.$tugasId)->with('gagal','Terjadi kesalahan. Coba mengumpulkan ulang');
        }
    }
}
