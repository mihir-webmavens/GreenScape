<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Mail\OrderInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/checkoutProcess",
     *     summary="Process Checkout",
     *     tags={"Checkout"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "name", "phone", "address", "city", "state", "zip", "country"},
     *             @OA\Property(property="name", type="string", example="user"),
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="phone", type="string", example="9846899108"),
     *             @OA\Property(property="address", type="string", example="near xyz, opp ghk"),
     *             @OA\Property(property="city", type="string", example="ahmedabad"),
     *             @OA\Property(property="state", type="string", example="gujarat"),
     *             @OA\Property(property="zip", type="string", example="204021"),
     *             @OA\Property(property="country", type="string", example="india")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Checkout successful"),
     *     @OA\Response(response=400, description="Validation error")
     * )
     */

    public function checkoutProcess(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:addresses',
            'phone' => 'required|unique:addresses',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|numeric|digits:6',
            'country' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => True,
                'message' => $validate->errors(),
            ]);
        }

        $data = [
            'name' => "$request->name",
            'email' => "$request->email",
            'phone' => "$request->phone",
            'address' => "$request->address",
            'city' => "$request->city",
            'state' => "$request->state",
            'zip' => "$request->zip",
            'country' => "$request->country",
            'user_id' => (int) auth()->id(),
        ];
        Address::create($data);
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
        $order =  Order::create([
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
            'address' => $address,
            'OrderId' => $orderId,
            'OrderDate' => $orderDate,
        ];
        Mail::to(auth()->user()->email)->send(new OrderInformation($Emaildata));

        return response()->json([
            [
                'success' => true,
                'message' => 'Checkout process successfuly run'
            ]
        ]);
    }
    public function checkoutProcessWithAddress(Request $request)
    {
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

        return response()->json([
            [
                'success' => true,
                'message' => 'Checkout process successfuly run'
            ]
        ]);
    }
}
