<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    protected $fillable = ['category_id', 'name', 'image'];

    // Define the relationship to the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function allChildren()
    {
        return $this->hasMany(ChildCategory::class, 'subcategory_id');
    }
}
