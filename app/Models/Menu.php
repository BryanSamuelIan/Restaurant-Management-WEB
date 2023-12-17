<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'description',
        'price',
        'alcohol%',
        'photo'
    ];

    public function menu_purchaseds() {
        return $this->hasMany(Menu_purchased::class);
    }

    public function transaction_menu() {
        return $this->hasMany(Transaction_menu::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
}
