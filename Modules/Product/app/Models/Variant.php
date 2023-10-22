<?php

namespace Modules\Product\app\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Modules\Attribute\app\Models\Attributable;
use Modules\Business\app\Models\Business;
use Modules\Measurement\app\Models\Unit;
use Modules\Stock\app\Models\Stock;
use Plank\Mediable\Mediable;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class Variant extends Model
{
    use CentralConnection, HasUuids, Mediable, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'name',
        'slug',
        'barcode',
        'size',
        'unit_code',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'media',
        'unit',
        'product',
        // 'attributables'
    ];

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name'],
            ],
        ];
    }

    public function title(): Attribute
    {
        return Attribute::get(function () {
            return $this->name ? $this->name.' &rsaquo; '.$this->product->name : $this->product->name;
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function stocked(): Attribute
    {
        return Attribute::get(fn () => $this->hasMany(Stock::class)->sum('available'));
    }

    public function businesses()
    {
        return $this->morphedByMany(Business::class, 'stockable', Stock::class, null, 'stockable_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_code', 'code');
    }

    public function attributables()
    {
        return $this->morphMany(Attributable::class, 'attributable');
    }

    /**
     * Return custom array of attributes & values only.
     */
    public function attributes()
    {
        // code...
    }
}
