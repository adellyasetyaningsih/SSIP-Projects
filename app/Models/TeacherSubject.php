<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    use HasFactory;

    protected $table = 'teacher_subject';
    protected $fillable = [
        'teacher_id',
        'subject_id',
        'time_slot_id',
    ];

    public $timestamps = false;
    public $incrementing = false; // Karena primary key komposit (teacher_id, subject_id)
}