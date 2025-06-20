<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'total',
        'transaction_time',
        'payment'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
