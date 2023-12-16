<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_menu extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'transaction_id',
        'menu_id',
        'amount'
    ];

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }
}
