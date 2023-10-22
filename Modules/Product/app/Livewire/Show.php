<?php

namespace Modules\Product\app\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use Modules\Product\app\Models\Product;
use Modules\Product\app\Models\Variant;
use Modules\Stock\app\Models\Stock;
use Modules\User\app\Models\User;

class Show extends Component
{
    public $user;

    public ?Product $product = null;

    public ?Variant $variant = null;

    public ?Stock $stock = null;

    public $variants;

    public $stocks;

    public $data = [];

    public function mount()
    {
        if (! request('sku')) {
            return redirect()->route('product.index', array_merge(['product' => $this->product->slug], request()->toArray()));
        }

        $this->user = auth()->check() ? User::find(auth()->user()->id) : null;

        $this->data['reviews'] = [];
        $this->data['amount'] = '0.00';
    }

    public function render(Request $request)
    {
        if ($request->sku) {
            $this->stock = Stock::where('sku', $request->sku)->orWhere('id', $request->sku)->first();
            $price = number_format_k(optional($this->stock->price)->amount ?? 0);

            $price_paths = explode('.', $price ?? '0.00');
            $this->data['amount'] = setting('currency', 'NGN').' '."$price_paths[0].<small>{$price_paths[1]}</small>";

            $this->variant = $this->stock->variant ?? null;
        } elseif ($request->variant) {
            $this->variant = Variant::find($request->variant);
        } else {
        }

        // Title
        $this->data['head']['title'] = $this->stock->title;

        // Images
        $this->data['featured_image_thumb'] = asset('app').'/img/shop/single/gallery/th05.jpg';
        if (isset($this->stock) and $this->stock->hasMedia(['image', 'thumb'])) {
            $this->data['featured_images'] = $this->stock->media(['image', 'thumb'])->get();
            $this->data['featured_image_thumb'] = $this->stock->media(['image', 'thumb'])->first()->getUrl();
        } elseif (isset($this->variant) and $this->variant->hasMedia(['image', 'thumb'])) {
            $this->data['featured_images'] = $this->variant->media(['image', 'thumb'])->get();
            $this->data['featured_image_thumb'] = $this->variant->media(['image', 'thumb'])->first()->getUrl();
        } elseif ($this->product->hasMedia(['image', 'thumb'])) {
            $this->data['featured_images'] = $this->product->media(['image', 'thumb'])->get();
            $this->data['featured_image_thumb'] = $this->product->media(['image', 'thumb'])->first()->getUrl();
        }

        // Reviews
        if ($this->stock and $this->stock->reviews) {
            $this->data['reviews'] = $this->stock->reviews;
        } elseif ($this->variant and $this->variant->reviews) {
            $this->data['reviews'] = $this->variant->reviews;
        } elseif ($this->product->reviews) {
            $this->data['reviews'] = $this->product->reviews;
        }

        return view('product::livewire.show', $this->data);
    }
}
