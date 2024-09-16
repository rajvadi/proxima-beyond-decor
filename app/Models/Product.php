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
        'code',
        'description',
        'material',
        'finishes',
        'price_per',
        'MRP',
        'status'
    ];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')
            ->withPivot('id') // Include the 'id' of the pivot table (product_attributes) for referencing in AttributeValue
            ->withTimestamps();
    }

    // Define the one-to-many relationship between Product and AttributeValue
    public function attributeValues()
    {
        return $this->hasManyThrough(AttributeValue::class, ProductAttribute::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
