<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlantController extends Controller
{

   /**
     * @OA\Post(
     *     path="/api/addPlant",
     *     summary="Add a new Plant",
     *     tags={"Plant"},    
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"name"},
     *                 @OA\Property(property="name", type="string", example="Test Plant"),
     *                 @OA\Property(property="image", type="string", format="binary")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Plant added successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Plant added successfully")
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

    public function addplant(Request $request){

        $data = Validator::make($request->all(),[
            'name' => 'required',
            'image' => 'image|',
        ]);

        if ($data->fails()){
            return response()->json([
                "error" => True,
                'message'=> $data->errors(),
            ]);
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagePath = $image->store('Plants','public');
        }else{
            $imagePath = "default.jpg";
        }

        Plant::create([
            'image'=> $imagePath,
            'name'=> $request->name
        ]);

        return response()->json([
            'success'=> True,
            'message'=> 'Plant Add successfully'
        ]);
    }
}
