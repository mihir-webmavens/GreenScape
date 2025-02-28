<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\CodeCleaner\ReturnTypePass;

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
        $item = Cart::find($request->product_id);
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

}
