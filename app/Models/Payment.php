<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $primaryKey = 'pay_ID'; // Tentukan nama kolom primary key
    public $incrementing = false;     // Jika pay_ID bukan auto-increment
    protected $keyType = 'string';    // Jika pay_ID bertipe string

    protected $fillable = [
        'student_id',
        'pay_status',
    ];

    // Set default status ke 'pending' saat membuat data
    protected $attributes = [
        'pay_status' => 'pending', // Default status
    ];

    /**
     * Relasi ke model Student
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}

