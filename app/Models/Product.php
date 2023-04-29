<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected static function booted()
    {
        // static::addGlobalScope('store', function (Builder $builder) {
        //     $user = Auth::user();
        //     if ($user->store_id) {
        //         $builder->where('store_id', '=', $user->store_id);
        //     }
        // });
        static::creating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });
    }
    protected $hidden = [

        'created_at', 'updated_at', 'deleted_at',
    ];
    public function store()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function categore()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tags_id', 'id', 'id');
    }
    // public function scopeFilter(Builder $builder, $filters)
    // {
    //     if ($filters['name'] ?? false) {
    //         $builder->where('products.name', 'LIKE', "%{$filters['name']}%");
    //     }
    //     if ($filters['status'] ?? false) {
    //         $builder->where('products.status', 'LIKE', "%{$filters['status']}%");
    //     }
    // }
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'Active');
    }
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * $this->price / $this->compare_price), 1);
    }
    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'tags_id' => null,
            'status' => 'active',

        ], $filters);
        $builder->when($options['store_id'], function ($builder, $value) {
            $builder->where('store_id', $value);
        });
        $builder->when($options['category_id'], function ($builder, $value) {
            $builder->where('category_id', $value);
        });
        $builder->when($options['tags_id'], function ($builder, $value) {
            $builder->whereHas('tags', function ($builder) use ($value) {
                $builder->where('id', $value);
            });
        });
        $builder->when($options['status'], function ($builder, $value) {
            $builder->where('status', $value);
        });
    }
}
