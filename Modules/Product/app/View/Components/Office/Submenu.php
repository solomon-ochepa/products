<?php

namespace Modules\Product\app\View\Components\Office;

use Illuminate\View\Component;
use Modules\Product\app\Models\Product;

class Submenu extends Component
{
    public $product;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Product $product = null)
    {
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('product::components.office.submenu');
    }
}
