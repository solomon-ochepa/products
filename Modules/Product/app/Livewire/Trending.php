<?php

namespace Modules\Product\app\Livewire;

use Livewire\Component;
use Modules\Stock\app\Models\Stock;

class Trending extends Component
{
    public $stocks;

    public $limit = 12;

    public function render()
    {
        $this->stocks = tenant() ? tenant()->stocks->take($this->limit)->shuffle() : Stock::inRandomOrder()->take($this->limit)->get()->shuffle();

        return view('product::livewire.trending');
    }
}
