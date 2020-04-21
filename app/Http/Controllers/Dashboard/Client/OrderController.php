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
        $orders = $client->orders()->with('products')->latest()->paginate(5);

        return view('dashboard.clients.orders.create',compact('client','categories','orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Client $client)
    {
//      dd( $request->all());
        $rules = ['products' => ['required', 'array'],
//                  'quantities' => ['required', 'array'],
                 ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->errors()->getMessages());
        }
        $this->attach_order($request, $client);

        alert()->success(__('site.success_job'),__('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');

    }


    public function edit(Client $client , Order $order)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->latest()->paginate(5);
        return view('dashboard.clients.orders.edit',compact('client','order','categories','orders'));
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
        $rules = ['products' => ['required', 'array'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->errors()->getMessages());
        }
        $this->dettach_order($order);
        $this->attach_order($request, $client);

        alert()->success(__('site.success_job'),__('site.updated_successfully'));
        return redirect()->route('dashboard.orders.index');
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

    private function attach_order($request, $client)
    {

        $total_price = 0;
        foreach($request->products as $id=>$quantity){
            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];
            $remain_stock = $product->stock - $quantity['quantity'];
            if ($remain_stock >= 0){
                $product->update([
                    'stock' => $product->stock - $quantity['quantity']
                ]);
            }
            else{
                alert()->error(__('error'),__('site.check_stock'));
                return redirect()->back();
            }
        }
        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);
        $order->update([
            'totalPrice' => $total_price
        ]);
    }

    private function dettach_order( $order)
    {

        foreach($order->products as $product){

            $product->update([
                'stock'=> $product->stock + $product->pivot->quantity

            ]);
        }
        $order->delete();
    }


}
