<?php

namespace Modules\Product\app\Livewire\Office\Edit;

use Livewire\Component;
use Modules\Brand\app\Models\Brand;
use Modules\Manufacturer\app\Models\Manufacturer;
use Modules\Product\app\Models\Product;
use Modules\User\app\Models\User;

class Form extends Component
{
    public User $user;

    /** @var Product product to be updated. */
    public Product $product;

    public array $original;

    public $manufacturers;

    public $brands;

    public $status;

    protected $rules = [
        'product.name' => ['required', 'string', 'min:3', 'max:64'],
        'product.subtitle' => ['nullable', 'string', 'min:3', 'max:64'],
        'product.description' => ['nullable', 'string', 'min:3', 'max:500'],
        'product.brand_id' => ['nullable', 'uuid', 'min:3', 'max:64'],
        'product.manufacturer_id' => ['nullable', 'uuid', 'min:3', 'max:64'],
    ];

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->original = $this->product->getOriginal();
        $this->manufacturers = Manufacturer::take(100)->get(['id', 'name']);
        $this->brands = Brand::take(100)->get(['id', 'name']);
    }

    public function render()
    {
        return view('product::livewire.office.edit.form');
    }

    public function update()
    {
        $this->validate();

        $this->product->update();

        session()->flash('status', 'Product updated successfully.');
        $this->dispatch('refresh');
    }
}
