<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create',compact('client','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Client $client)
    {
//      dd($client , $request->all());
        $rules = ['product_ids' => ['required', 'array'],
                  'quantities' => ['required', 'array'],
                 ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->errors()->getMessages());
        }
        $order = $client->orders->create([]);
        $total_price = 0;
        foreach($request->product_ids as $index=>$product_id){
             $product = Product::FindOrFail($product_id);
             $total_price += $product->sale_price;
            $order->products()->attach($product_id,['quantity'=>$request->quantities[$index]]);
            $product->update([
                'stock' => $product->stock - $request->quantities[$index]
            ]);
        }
$order->update([
    'total_price' => $total_price
]);

    }


    public function edit(Client $client , Order $order)
    {
        return view('dashboard.clients.orders.edit',compact('client','order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client, Order $order)
    {
        //
    }
}
