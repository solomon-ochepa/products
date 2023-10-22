<?php

namespace Modules\Product\app\Livewire;

use Livewire\Component;

class Product extends Component
{
    public $product;

    public $variant;

    public $stock;

    public $variant_id;

    public function mount($stock)
    {
        //
    }

    public function render()
    {
        if ($this->stock) {
            $this->variant = $this->stock->variant;
            $this->product = $this->stock->variant->product;
        } elseif ($this->variant) {
            $this->product = $this->variant->product;
        }

        // URL Queries
        $data['queries']['product'] = $this->product->slug;
        if ($this->variant) {
            $data['queries']['subtitle'] = $this->variant->slug ?? null;
            $data['queries']['size'] = $this->variant->size ? $this->variant->size.$this->variant->unit_code : null;
            $data['queries']['barcode'] = $this->variant->barcode;
        }
        if ($this->stock) {
            $data['queries']['sku'] = $this->stock->sku ?? $this->stock->id; // use ID only for system SKU
        } elseif ($this->variant) {
            $data['queries']['variant'] = $this->variant->id;
        }

        $data['image'] = $this->image($this->stock);
        if ($this->stock) {
            $data['price'] = $this->stock->price ? number_format_k($this->stock->price->amount) : '0.00';
            $data['stocked'] = number_format_k(ceil($this->stock->stocked), 0);
        } else {
            $data['price'] = 0;
            $data['stocked'] = 0;
        }

        return view('product::livewire.product', $data);
    }

    public function image()
    {
        if ($this->stock and $this->stock->hasMedia(['image'])) {
            return $this->stock->media('image')->first()->geturl();
        } elseif ($this->variant and $this->variant->hasMedia(['image'])) {
            return $this->variant->media('image')->first()->geturl();
        } elseif ($this->product and $this->product->hasMedia(['image'])) {
            return $this->product->media('image')->first()->geturl();
        } else {
            return '/app/img/marketplace/products/04.jpg';
        }
    }
}
