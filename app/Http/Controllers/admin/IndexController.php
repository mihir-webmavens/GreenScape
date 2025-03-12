<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Plant;
use App\Models\Product;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\EventListener\DisallowRobotsIndexingListener;

class IndexController extends Controller
{
    public function index(Request $request)
    {

        $visits = Visitor::count(); // Count total unique visitors
        $order = Order::count();
        $plant = Plant::count();
        $product = Product::count();
        $users = User::orderBy('id', 'desc')->get();
        $usersCount = User::with('address')->whereHas('address', function ($query) {
            $query->whereNotNull('country');
        })->get()->groupBy('address.country')->map->count();

        $currentMonth = Carbon::now()->month;
        $usersPerMonth = User::selectRaw('COUNT(id) as count, MONTH(created_at) as month')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')->pluck('count', 'month')->toArray();

        $usersPerMonth = array_replace(array_fill(1, 12, 0), $usersPerMonth);

        return view('backend.index', compact('visits', 'order', 'plant', 'product', 'users', 'usersCount','usersPerMonth'));
    }
}
