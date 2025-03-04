<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderList extends Component
{
    public $orders = [];
    public function mount($data){
        $this->orders = $data;
    }

    public function updateOrderStatus($id, $status){
        $order = Order::find($id);
        $order->status = $status;
        $order->save();
    }
    public function render()
    {
        return view('livewire.order-list');
    }
}
