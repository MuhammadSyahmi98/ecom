<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'price', 'description', 'additional_info', 'category_id', 'subcategory_id'];

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
