<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeSlot extends Model
{
    use HasFactory;
    protected $primaryKey = 'time_slot_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'time_slot_id',
        'category_id',
        'date',
        'start_time',
        'end_time',
        'subject_id',
        'teacher_id',
        'classroom',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }
}