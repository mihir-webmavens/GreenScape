<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function show(){
        $webinars = Webinar::all();
        return view("frontend.webinar",compact('webinars'));
    }
}
