<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
         'id',
         'user_id',       
         'total'
    ];

    protected $casts = [
        'items' => 'array',        
        'total' => 'decimal:2',
    ];

    // relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
