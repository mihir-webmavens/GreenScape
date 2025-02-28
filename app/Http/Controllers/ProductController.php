<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function shopSingleShow($id){
        $product = Product::find($id);
        return view('frontend.shop-single',compact('product'));
    }
    public function shopShow(){
        $products = Product::all();

        return view('frontend.shop',compact('products'));
    }
    public function addToCart(Request $request){
        $item = Cart::where('product_id',$request->product_id)->first();
        if($item){
            $item->quantity += $request->quantity;
            $item->save();
        }else{
            Cart::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'user_id' => auth()->id()
            ]);
        }
        return redirect()->back()->with('message','Product added to cart successfully');
    }
    public function cart(){
       $items = Cart::with('product')->where('user_id',auth()->id())->get();
       return view('frontend.cart',compact('items'));
    }
    public function cartItemRemove(Request $request){
    if($request->ajax()){
        Cart::find($request->cart_id)->delete();
        return response()->json(['message'=>'Item removed from cart successfully']);
    }else{
        return response()->json(['error'=>'Item not removed from cart']);
    }}

}
