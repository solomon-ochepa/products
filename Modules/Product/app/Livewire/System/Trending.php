<?php

namespace Modules\Product\app\Livewire\System;

use Livewire\Component;
use Modules\Product\app\Models\Variant;

class Trending extends Component
{
    public $products;

    public function render()
    {
        $this->products = Variant::take(8)->get()->shuffle();

        return view('product::livewire.system.trending');
    }
}
