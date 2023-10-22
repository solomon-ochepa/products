<?php

namespace Modules\Product\app\Livewire\Office;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Product\app\Http\Requests\StoreProductRequest;
use Modules\Product\app\Http\Requests\UpdateProductRequest;
use Modules\Product\app\Models\Product;

class ProductModal extends Component
{
    use WithFileUploads;

    /** Resource to be updated or created. */
    public Product $product;

    /** Determine if $product is to be edited. */
    public bool $edit = false;

    public $photo;

    /** @var URL existing image url or null */
    public $image;

    protected $listeners = ['refresh' => '$refresh'];

    protected function rules()
    {
        if ($this->edit) {
            $request = new UpdateProductRequest($this->product->toArray());

            return $request->rules();
        } else {
            $request = new StoreProductRequest();

            return $request->rules();
        }
    }

    public function render()
    {
        return view('product::livewire.office.product-modal');
    }
}
