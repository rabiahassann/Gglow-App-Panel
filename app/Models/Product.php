<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'subcategory_id',
        'location',
        'number',
        'images',
        'overview',
        'entry_access',
        'exlusive_benefits',
        'kids_nannyxs',
        'type',
        'price',
    ];

    protected $casts = [
        'images' => 'array',
        'type' => 'array',
        'price' => 'decimal:2',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
}
