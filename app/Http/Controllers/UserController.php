<?php

namespace App\Http\Controllers;

use App\Mail\OrderInformation;
use App\Mail\Testmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function show (){
        $users = User::where('role','user')->get();
        return view('backend.UserList',compact('users'));
    }
    public function AdminUsers (){
        $users = User::where('role','admin')->get();
        return view('backend.UserList',compact('users'));
    }

    public function RegisterProcess(Request $request)
    {
       $users = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'age' => 'required',
            'phone' => 'required|unique:users',
            'profile' => 'max:2048',
        ]);

            // dd($request->all());

        if($request->hasFile('profile')){
            $image = $request->file('profile');
            $imagePath = $image->store('Users','public');
            $users['profile'] = $imagePath;

        }else{
            $users['profile'] = 'Users/default1.png';

        }

        User::create($users);

        return redirect()->route('login');

    }

    public function LoginProcess(Request $request){
        return Auth::attempt($request->only('email','password')) ?  redirect()->route('index') : back()->with('status','Invalid login details');
    }
    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('index');
    }

    public function mail(){

        // Mail::to('mihir@webmavens.com')->send(new Testmail());
        Mail::to(auth()->user()->email)->send(new OrderInformation("test"));

    }

    public function details(){
        return view('frontend.userDetails');
    }
    public function upddate_profile(Request $request){

       $validate = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'. Auth::id(),
        'age' => 'required',
        'phone' => 'required|max:10|unique:users,phone,'.Auth::id(),
        'profile' => 'max:2048',
       ]);

         if($request->hasFile('profile')){

            User::find(Auth::id())->get();
            $old_image = User::find(Auth::id())->profile;
            if($old_image != 'img/users/default1.png'){
                Storage::disk('public')->delete($old_image);
            }

          $image = $request->file('profile');
          $imagePath = $image->store('Users','public');
          $validate['profile'] = $imagePath;
        }
          User::where('id',Auth::id())->update($validate);
        return redirect()->route('details')->with('status','Profile updated successfully');

}

}
