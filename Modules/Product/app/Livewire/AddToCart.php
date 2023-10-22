<?php

namespace Modules\Product\app\Livewire;

use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use Modules\Cart\app\Models\Cart;
use Modules\Guest\app\Models\Guest;

class AddToCart extends Component
{
    public $item;

    public $quantity = 1;

    public $icon = true;

    public array $data = [];

    protected $listeners = ['refresh' => '$refresh', 'cart.refresh' => '$refresh'];

    public function mount($item)
    {
        if (auth()->guest()) {
            if (Cookie::has('guest')) {
                if (! Guest::find($this->data['user_id'] = Cookie::get('guest'))) {
                    $this->data['user_id'] = Guest::create(['ip_address' => request()->ip()])->value('id');
                    Cookie::queue('guest', $this->data['user_id']);
                }
            } else {
                $this->data['user_id'] = Guest::create(['ip_address' => request()->ip()])->value('id');
                Cookie::queue('guest', $this->data['user_id']);
            }

            $this->data['guest'] = 1;
        } else {
            $this->data['user_id'] = auth()->id();
        }
    }

    public function render()
    {
        return view('product::livewire.add-to-cart');
    }

    public function add_to_cart()
    {
        $cart = Cart::updateOrCreate($this->data);

        $cart->items()->updateOrCreate([
            'stock_id' => $this->item->id,
        ], [
            'quantity' => $this->quantity ?? 1,
            'price' => $this->item->price->amount ?? 0,
        ]);

        $cart->calculate();

        $this->dispatch('cart.refresh');

        session()->flash('status', 'Item added to cart successfully.');
    }
}
