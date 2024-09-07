<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'attribute_id',
        'status'
    ];

    // Define the inverse one-to-many relationship between ProductAttribute and Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Define the inverse one-to-many relationship between ProductAttribute and Attribute
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    // Define the one-to-many relationship between ProductAttribute and AttributeValue
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'product_attribute_id');
    }
}
