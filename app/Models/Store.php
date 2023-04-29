<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Query\Builder;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{

    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo_image',
        'cover_image',
        'status',
        'rating'
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }
    // public function scopeFilter(Builder $builder, $filters)
    // {
    //     if ($filters['name'] ?? false) {
    //         $builder->where('stores.name', 'LIKE', "%{$filters['name']}%");
    //     }
    //     if ($filters['status'] ?? false) {
    //         $builder->where('stores.status', 'LIKE', "%{$filters['status']}%");
    //     }
    // }
}