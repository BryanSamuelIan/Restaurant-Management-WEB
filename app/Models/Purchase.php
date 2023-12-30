<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
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

    public function menu_purchaseds() {
        return $this->hasMany(Menu_purchased::class);
    }
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_purchaseds'); // Specify the custom pivot table name
    }
}
