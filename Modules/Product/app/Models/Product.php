<?php

namespace Modules\Product\app\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Brand\app\Models\Brand;
use Modules\Manufacturer\app\Models\Manufacturer;
use Modules\Measurement\app\Models\Measurable;
use Modules\Measurement\app\Models\Unit;
use Modules\Stock\app\Models\Stock;
use Modules\Stock\app\Models\Stocking;
use Plank\Mediable\Mediable;

class Product extends Model
{
    use HasFactory, HasUuids, Sluggable, Mediable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'active', 'name', 'slug', 'description', 'brand_id', 'manufacturer_id',
    ];

    /**
     * The relationships that should always be loaded.
     */
    protected $with = [
        'media',
        // 'variants',
        // 'brand'
    ];

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // public function attributables()
    // {
    //     return $this->morphMany(Attributable::class, 'attributable');
    // }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function units()
    {
        return $this->morphToMany(Unit::class, 'measurable', Measurable::class);
    }

    public function measurables()
    {
        return $this->morphMany(Measurable::class, 'measurable');
    }

    public function stock()
    {
        return $this->stocks();
    }

    public function stocks()
    {
        return $this->hasManyThrough(Stock::class, Variant::class);
    }

    public function stockings()
    {
        return $this->hasManyThrough(Stocking::class, Variant::class);
    }

    public function businesses()
    {
        return collect(); // $this->hasManyThrough(Stock::class, Variant::class);
    }
}
