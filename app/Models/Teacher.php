<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;

    protected $primaryKey = 'teacher_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'teacher_id',
        'teacher_f_name', // Sesuaikan dengan nama kolom di database
        'teacher_l_name', // Sesuaikan dengan nama kolom di database
        'classroom',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'teacher_category', 'teacher_id', 'category_id')->withPivot('subject_id');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject', 'teacher_id', 'subject_id')->withPivot('time_slot_id');
    }

    public function timeSlots(): HasMany
    {
        return $this->hasMany(TimeSlot::class, 'teacher_id'); // Tambahkan foreign key
        
    }
}