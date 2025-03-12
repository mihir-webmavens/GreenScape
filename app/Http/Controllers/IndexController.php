<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $ip = $request->ip();
        // Check if visitor with the same IP exists
        if (!Visitor::where('ip_address', $ip)->exists()) {
            Visitor::create([
                'ip_address' => $ip,
                'visit_date' => now(),
            ]);
        } else {
            Visitor::where('ip_address', $ip)->increment('hits');
        }
        $visits = Visitor::count(); 

        return view('frontend.index');
    }
}
