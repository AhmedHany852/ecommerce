<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function products()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    public function category()
    {
        return $this->hasMany(Product::class, 'parent_id', 'id');
    }

    public static function rules()
    {
    }
    public function scopeFilter(Builder $builder, $filters)
    {
        if ($filters['name'] ?? false) {
            $builder->where('categories.name', 'LIKE', "%{$filters['name']}%");
        }
        if ($filters['name'] ?? false) {
            $builder->where('categories.status', 'LIKE', "%{$filters['status']}%");
        }
    }
}