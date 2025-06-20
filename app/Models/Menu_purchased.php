<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_purchased extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'purchase_id',
        'menu_id',
        'price',
        'quantity'
    ];

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function purchase() {
        return $this->belongsTo(Purchase::class);
    }
}
