<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // public function class(){
    //     return $this->hasOne(Classes::class);
    // }
    protected $fillable = [
        'name',
        'description',
        'due',
        'class_id',
        'user_id',
        'status'
    ];

    public function class(){
        return $this->belongsTo(Classes::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
