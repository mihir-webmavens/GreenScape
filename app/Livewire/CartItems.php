<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartItems extends Component
{
    public $items = [];
    public $count = 10;

    public function mount()
    {
        $this->items = Cart::where('user_id', auth()->id())->get();
    }

    public function removeItem($id)
    {
        Cart::find($id)->delete();
        $this->items = Cart::where('user_id', auth()->id())->get();
    }
    public function updateQuantity($id, $quantity)
    {
        $cart = Cart::find($id);
        $cart->quantity = $quantity;
        $cart->save();
        $this->items = Cart::where('user_id', auth()->id())->get();

    }


    public function render()
    {
        return view('livewire.cart-items');
    }
}
