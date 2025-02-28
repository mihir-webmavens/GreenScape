<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkoutProcess(Request $request){

        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:addresses',
            'phone' => 'required|unique:addresses',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|numeric|digits:6',
            'country' => 'required',
        ]);
        $validate['user_id'] = auth()->id();
        Address::create($validate);

       $data = Cart::with('product')->where('user_id', auth()->id())->get();
       $address = Address::where('user_id', auth()->id())->first();

       $ProductDetails = null;
       foreach ($data as $key => $value) {
              $ProductDetails[] = [
                'product_id' => $value->product_id,
                'quantity' => $value->quantity,
                'price' => $value->product->price,
              ];
       };
        Order::create([
            'user_id' => auth()->id(),
            'products' => json_encode($ProductDetails),
            'address_id' => $address->id,
            'amount' => '-',
        ]);
        Cart::where('user_id', auth()->id())->delete();
        return redirect()->route('shop')->with('success','Order Placed Successfully');
    }
    public function checkoutProcessWithAddress(Request $request){

        
       $data = Cart::with('product')->where('user_id', auth()->id())->get();
       $address = Address::where('user_id', auth()->id())->first();

       $ProductDetails = null;
       foreach ($data as $key => $value) {
              $ProductDetails[] = [
                'product_id' => $value->product_id,
                'quantity' => $value->quantity,
                'price' => $value->product->price,
              ];
       };
        Order::create([
            'user_id' => auth()->id(),
            'products' => json_encode($ProductDetails),
            'address_id' => $address->id,
            'amount' => '-',
        ]);
        Cart::where('user_id', auth()->id())->delete();
        return redirect()->route('shop')->with('success','Order Placed Successfully');
    }

    public function checkout() {
        $address = Address::where('user_id', auth()->id())->first();
        if($address){
            $items = Cart::with('product')->where('user_id', auth()->id())->get();
            return view('frontend.checkout',compact('items','address'));
        }else{
            $items = Cart::with('product')->where('user_id', auth()->id())->get();
            return view('frontend.checkout',compact('items'));
        }


    }

}
