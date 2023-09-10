<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_offer',
        'offer_value',
    ];

    public function UserProduct()
    {
        return $this->belongsTo(User::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function images()
{
    return $this->hasMany(ProductImage::class);
}


}
