<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_type extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
