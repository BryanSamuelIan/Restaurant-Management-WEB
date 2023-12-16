<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'sallary',
        'ktp',
        'is_active'
    ];

    public function user() {
        return $this->hasOne(User::class);
    }
}
