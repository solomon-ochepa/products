<?php

namespace Modules\Product\app\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public $data = [];

    public function render()
    {
        return view('product::livewire.sidebar', $this->data);
    }
}
