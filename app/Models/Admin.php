<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins'; // Pastikan nama tabel sesuai, sudah benar
    protected $primaryKey = 'admin_email';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'admin_name',
        'admin_email',
        'admin_password',
    ];

    protected $hidden = [
        'admin_password',
        'remember_token',
    ];

    // Kasih tahu Laravel kalau password-nya bukan 'password' biasa
    public function getAuthPassword()
    {
        return $this->admin_password;
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}