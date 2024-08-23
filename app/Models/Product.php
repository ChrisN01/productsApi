<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'customer', 'review', 'star'
    ];
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
