<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySubject extends Model
{
    use HasFactory;

    protected $table = 'category_subject';
    protected $fillable = [
        'category_id',
        'subject_id',
    ];

    public $timestamps = false;
    public $incrementing = false; // Karena primary key komposit
}