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
        'is_alcohol',
        'alcohol%',
        'stock',
        'photo',
        'is_combo',
        'parent_id',
        'combo_quantity'
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

    public function parent(){
        return $this->belongsTo(Menu::class);
    }
    public function combo(){
        return $this->hasMany(Menu::class);
    }
}
