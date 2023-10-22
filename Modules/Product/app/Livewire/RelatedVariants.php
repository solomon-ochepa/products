<?php

namespace Modules\Product\app\Livewire;

use Livewire\Component;
use Modules\Product\app\Models\Variant;
use Modules\Stock\app\Models\Stock;

class RelatedVariants extends Component
{
    public ?Stock $stock;

    public function mount($stock)
    {
        //
    }

    public function render()
    {
        if ($this->stock) {
            $product_id = $this->stock->variant->product->id;
            $variants_id = Variant::where('product_id', $product_id)->whereNotIn('id', [$this->stock->variant->id])->pluck('id')->toArray();
        }

        $data['stocks'] = isset($variants_id) ? Stock::whereIn('variant_id', $variants_id)->get() : [];

        // $related = Stock::wherei('variant_id', function ($query) {
        //     // dd($query);
        // });

        return view('product::livewire.related-variants', $data);
    }
}
