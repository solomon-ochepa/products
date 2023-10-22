<?php

namespace Modules\Product\app\Livewire\Office;

use Livewire\Component;
use Modules\Measurement\app\Models\Unit;

class Variants extends Component
{
    public $product;

    protected $rules = [
        'product.variants.*.name' => ['nullable', 'string'],
        'product.variants.*.barcode' => ['nullable', 'string'],
        'product.variants.*.size' => ['nullable'],
        'product.variants.*.unit_code' => ['nullable', 'uuil'],
    ];

    protected $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        $data['display'] = 'grid';
        $data['units'] = Unit::all();

        return view('product::livewire.office.variants', $data);
    }

    public function update()
    {
        if ($this->product->variants ?? []) {
            $this->product->variants->each->update();

            session()->flash('status', 'Variants update successful.');

            $this->product->refresh();
            $this->dispatch('refresh');
        }
    }
}
