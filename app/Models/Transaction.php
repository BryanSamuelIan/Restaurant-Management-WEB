<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_time',
        'payment_type_id',
        'status_id',
        'subtotal',
        'total'
    ];

    public function transaction_menus() {
        return $this->hasMany(Transaction_menu::class);
    }

    public function payment_type() {
        return $this->belongsTo(Payment_type::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }
}
