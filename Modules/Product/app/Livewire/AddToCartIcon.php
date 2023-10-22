<?php

namespace Modules\Product\app\Livewire;

use Livewire\Component;
use Modules\Cart\app\Models\Cart;

class AddToCartIcon extends Component
{
    public $quantity = 1;

    public $item;

    public function mount($item)
    {
        //
    }

    public function render()
    {
        return view('product::livewire.add-to-cart-icon');
    }

    public function add_to_cart()
    {
        $cart = Cart::firstOrcreate(['user_id' => auth()->id()]);
        $quantity = $this->quantity ?? 1;
        $price = $this->item->price->amount ?? 0;

        $item = $cart->items()->firstOrCreate(
            [
                'stock_id' => $this->item->id,
                'quantity' => $quantity,
                'price' => $this->item->price->amount ?? 0,
                'amount' => $quantity * $price,
            ]
        );

        $cart->calculate();

        session()->flash('status', 'Item added to cart successfully.');
    }
}
