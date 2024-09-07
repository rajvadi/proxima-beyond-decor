<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // Define the many-to-many relationship between Attribute and Product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes')
            ->withPivot('id') // Include 'id' of the pivot table (product_attributes)
            ->withTimestamps();
    }

    // One-to-Many relationship between Attribute and AttributeValue via ProductAttribute
    public function attributeValues()
    {
        return $this->hasManyThrough(AttributeValue::class, ProductAttribute::class, 'attribute_id', 'product_attribute_id');
    }
}
