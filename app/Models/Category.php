<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';
    public $incrementing = false;
    protected $fillable = [
        'category_id', 'price', 'quota'
    ];

    public function students() {
        return $this->hasMany(Student::class, 'category_id');
    }

    public function subjects() {
        return $this->hasMany(Subject::class, 'category_id');
    }

}