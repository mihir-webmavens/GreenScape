<?php

namespace App\Http\Controllers;

use App\Mail\OrderInformation;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


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
        $Emaildata = [
            'product' => $ProductDetails,
            'address' => $address,
        ];
        Mail::to(auth()->user()->email)->send(new OrderInformation($Emaildata));

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
        $order = Order::create([
            'user_id' => auth()->id(),
            'products' => json_encode($ProductDetails),
            'address_id' => $address->id,
            'amount' => '-',
        ]);

        $orderId = $order->id;
        $orderDate = $order->created_at->format('Y-m-d H:i:s');

        Cart::where('user_id', auth()->id())->delete();
        $Emaildata = [
            'product' => $ProductDetails,
            'Address' => $address,
            'OrderId' => $orderId,
            'OrderDate' => $orderDate,
        ];
        Mail::to(auth()->user()->email)->send(new OrderInformation($Emaildata));

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

    public function UserOrders(){
        $orders = Order::with(['user'])->where('user_id', auth()->id())->get();
        return view ('frontend.User-order',compact('orders'));
    }

    public function UserOrdersDetails($id){
        $productId = [];
        $quantity = [];
       $order = Order::find($id);
       $data = json_decode($order->products, true);
       foreach($data as $val){
         $productId[] = $val['product_id'];
         $quantity[] = $val['quantity'];
       }
       $products = Product::whereIn('id',$productId)->get();
        return view('frontend.user-order-details',compact('order','products','quantity'));
    }


    // admin side

    public function orderlist(){
        $orders = Order::with(['user', 'address'])->get();
        $productId = [];
        // foreach( $orders as $order){
        //     $productId[] = json_decode($order->products);
        // }
        // return $orders;
        // // $products = Products::where()
        return view("backend.orderList",compact('orders'));
    }

}
