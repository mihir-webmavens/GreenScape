<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/addToCart/{productId}",
     *     summary="Add Product to Cart",
     *     tags={"Product"},
     *     security={{"bearerAuth":{}}},
     *     
     *     @OA\Parameter(
     *         name="productId",
     *         in="path",
     *         required=true,
     *         description="ID of the product to add to the cart",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=200, description="Product added to cart successfully or already exists"),
     *     @OA\Response(response=400, description="Product Id invalid"),
     *     
     * )
     * @OA\Post(
     *     path="/api/addProduct",
     *     summary="Add a new product",
     *     tags={"Product"},    
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"name", "sku", "price", "brand", "description", "image"},
     *                 @OA\Property(property="name", type="string", example="Test Product"),
     *                 @OA\Property(property="sku", type="string", example="UUZ001"),
     *                 @OA\Property(property="price", type="number", format="float", example=250.00),
     *                 @OA\Property(property="brand", type="string", example="Bata"),
     *                 @OA\Property(property="description", type="string", example="This is a product description."),
     *                 @OA\Property(property="image", type="string", format="binary")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product added successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Product added successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="boolean", example=true),
     *             @OA\Property(property="message", type="object")
     *         )
     *     )
     * )

     */


    public function addToCart(Request $request, $id)
    {
        $item = Cart::where('product_id', $request->product_id)->first();

        $product = Product::find($id);


        if ($product) {
            if ($item) {
                $item->quantity += $request->quantity;
                $item->save();
                return response()->json([
                    'message' => 'Product already exists in cart'
                ], 200);
            } else {
                Cart::create([
                    'product_id' => $id,
                    'quantity' => $request->quantity,
                    'user_id' => (int) auth()->id()
                ]);
                return response()->json([
                    'message' => 'Product added to cart successfully'
                ], 200);
            }
        } else {
            return response()->Json([
                'message' => 'Invalid Product Id'
            ], 400);
        }
    }

    public function addProduct(Request $request)
    {
        $data = Validator::make($request->all(), [
            'name' => 'required',
            'sku' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'description' => 'required',
        ]);

        if ($data->fails()) {
            return response()->json([
                ['error' => true, 'message' => $data->errors()]
            ]);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('Users', 'public');
        } else {
            $imagePath = 'Products/default.jpg';
        }

        Product::create([
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'brand' => $request->brand,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return response()->json([
            'success' => True,
            'message' => 'Product added successfully'
        ]);
    }
}
