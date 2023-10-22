<?php

namespace Modules\Product\app\Livewire;

use Livewire\Component;

class Stock extends Component
{
    public $stock;

    public function render()
    {
        $data['query']['stock'] = $this->stock->id;
        $data['query']['name'] = $this->stock->variant->product->slug;
        $data['query']['subtitle'] = $this->stock->variant->slug;
        $data['query']['size'] = $this->stock->variant->size ? $this->stock->variant->size.$this->stock->variant->unit_code : null;
        $data['query']['barcode'] = $this->stock->variant->barcode;

        $data['image'] = $this->image($this->stock);
        $data['price'] = $this->stock->price ? number_format_k($this->stock->price->amount) : '0.00';
        $data['stocked'] = number_format_k(ceil($this->stock->stocked), 0);

        return view('product::livewire.stock', $data);
    }

    public function image($stock)
    {
        if ($stock->hasMedia(['image'])) {
            return $stock->media('image')->first()->geturl();
        } elseif ($stock->variant->hasMedia(['image'])) {
            return $stock->variant->media('image')->first()->geturl();
        } elseif ($stock->variant->product->hasMedia(['image'])) {
            return $stock->variant->product->media('image')->first()->geturl();
        } else {
            return '/app/img/marketplace/products/04.jpg';
        }
    }
}
