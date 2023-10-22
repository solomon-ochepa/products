<?php

namespace Modules\Product\app\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\app\Models\Product;
use Modules\Stock\app\Models\Stock;
use Modules\User\app\Models\User;

class Index extends Component
{
    use WithPagination;

    public $user;

    public $stocks;

    public Product $product;

    private $data = [];

    public function __construct()
    {
        // Initialize Product
        $this->product = new Product();
    }

    public function mount()
    {
        $this->user = auth()->check() ? User::find(auth()->user()->id) : null;

        if ($this->product->exists) {
            $this->data['reviews'] = [];
        }
    }

    public function render()
    {
        // Title
        if ($this->product->exists) {
            $this->data['head']['title'] = $this->product->name;
            $this->stocks = $this->product->stocks;
        } else {
            $this->data['head']['title'] = __('Products');
            $this->stocks = Stock::where(['active' => 1, 'private' => 0])->get();
        }

        return view('product::livewire.index', $this->data);
    }
}
