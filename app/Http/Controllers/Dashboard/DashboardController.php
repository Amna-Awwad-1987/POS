<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $categories = Category::count();
        $products = Product::count();
        $clients = Client::count();
        $orders = Order::count();
        return view('dashboard.welcome',compact('categories','products','clients','orders'));
    }
}
