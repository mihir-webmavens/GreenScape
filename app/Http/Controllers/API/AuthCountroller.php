<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="My API Documentation",
 *      description="This is a sample API documentation for my Laravel project.",
 *      @OA\Contact(
 *          email="support@example.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 * 
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="API Server"
 * )
 */


class AuthCountroller extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="User Registration",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password", "password_confirmation"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="age", type="string",example="20"),
     *             @OA\Property(property="phone", type="string",example="9123875898"),
     *             @OA\Property(property="profile", type="file",example="defaul1.jpg"),
     *             @OA\Property(property="password", type="string", format="password", example="securepassword"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="securepassword")
     *         )
     *     ),
     *     @OA\Response(response="201", description="User registered successfully"),
     *     @OA\Response(response="422", description="Validation error", 
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The password confirmation does not match."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="password", type="array",
     *                     @OA\Items(type="string", example="The password confirmation does not match.")
     *                 )
     *             )
     *         )
     *     )
     * )
     * @OA\Post(
     *     path="/api/login",
     *     summary="User Login",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="mypassword123")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Login successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     *  
     *   @OA\Post(
     *     path="/api/logout",
     *     summary="User Logout",
     *     tags={"Authentication"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Logout successful"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */


    public function signup(Request $request)
    {
        $users = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'age' => 'required',
            'phone' => 'required|unique:users',
            'profile' => 'max:2048',
        ]);
        if ($users->fails()) {
            return response()->json([
                'message' => True,
                'error' => $users->errors(),
            ]);
        }
        $users = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'age' => $request->age,
            'phone' => $request->phone,
            'profile' => $request->profile,
        ];
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $imagePath = $image->store('Users', 'public');
            $users['profile'] = $imagePath;
        } else {
            $users['profile'] = 'Users/default1.png';
        }

        User::create($users);

        return response()->json([
            'status' => True,
            'messagw' => "User created successfuly",
        ]);
    }

    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
        ]);

        // Return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Validation failed",
                'errors' => $validator->errors(),
            ], 401);
        }

        // Attempt to authenticate user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();

            // Generate and return token
            return response()->json([
                'status' => true,
                'message' => "Successfully logged in",
                'token' => $authUser->createToken("Api")->plainTextToken,
                'user' => $authUser,
            ], 200);
        }

        // Authentication failed
        return response()->json([
            'status' => false,
            'message' => "Credentials do not match",
        ], 401);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => "User not authenticated"
            ], 401);
        }

        $user->tokens()->delete(); // Fix: Use `tokens()` instead of `tokens`

        return response()->json([
            'status' => true,
            'message' => "Successfully logged out"
        ], 200);
    }
}
