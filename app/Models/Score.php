<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $guarded = ['$id'];

    protected $fillable = [
        'user_id',
        'task_id',
        'score',
        'reviewed'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
