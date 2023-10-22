<?php

namespace Modules\Product\app\Livewire\Office;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\app\Models\Product;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $limit = 30;

    protected $listeners = ['search' => 'search'];

    public function search($search = null)
    {
        return $this->search = $search['query'];
    }

    public function render()
    {
        $data['display'] = 'grid';
        $data['user'] = auth()->user();

        // Auto generate a Variant
        $products_without_variants = Product::whereDoesntHave('variants')->get();
        foreach ($products_without_variants as $key => $product) {
            $product->variants()->create();
            $product->refresh();
        }

        if ($this->search) {
            $data['products'] = Product::where(function ($product) {
                $cols = ['name', 'description'];
                foreach ($cols as $col) {
                    $product->where($col, 'like', '%'.$this->search.'%');
                }
            })->latest()->paginate($this->limit);
        } else {
            $data['products'] = Product::latest()->paginate($this->limit);
        }

        return view('product::livewire.office.index', $data);
    }
}
