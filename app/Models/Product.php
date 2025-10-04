<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'image',
    ];

    /**
     * Casts for attributes.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    /**
     * Relationship: a product can have many order items.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
