<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherCategory extends Model
{
    use HasFactory;

    protected $table = 'teacher_category';
    protected $fillable = [
        'teacher_id',
        'category_id',
        'subject_id',
    ];

    public $timestamps = false;
    public $incrementing = false; // Penting untuk primary key komposit
}