<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Product;
use App\ProductTranslation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search, function($query) use($request ){

            return $query->whereTranslationLike( 'name', '%'. $request->search . '%');
            })->when($request->category_id, function($q) use($request ){

            return $q->where( 'category_id', $request->category_id );
        })->latest()->paginate(4);

       return view('dashboard.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create' ,compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $rules = ['category_id' => 'required'];

        foreach (config('translatable.locales') as $locale){
            $rules += [ $locale . '.name'=> ['required' ,Rule::unique('Product_translations', 'name')],
                        $locale . '.description'=> ['required' ,Rule::unique('Product_translations', 'description')]
                ];
        }
        $rules += [
                'image' => ['image'],
                'purchase_price' => 'required',
                'sale_price' => 'required',
                'stock' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->errors()->getMessages());
        }

        $request_data = $request->except(['image']);

        if($request->hasFile('image')){
            Image::make($request->file('image'))
                ->resize(100,null , function ($constraint){
                    $constraint->aspectRatio();
                })->save('uploads/products/' . $request->file('image')->hashName(), 80);
            $request_data['image'] = $request->file('image')->hashName();

        }
        $Product = Product::create($request_data);
        alert()->success(__('site.success_job'),__('site.added_successfully'));
        return redirect('/dashboard/products');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
      return view('dashboard.products.edit',compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        $product = Product::find($id);

        $rules = ['category_id' => 'required'];

        foreach (config('translatable.locales') as $locale){
            $rules += [ $locale . '.name'=> ['required' ,Rule::unique('Product_translations', 'name')->ignore($product->id ,'product_id' )],
                $locale . '.description'=> ['required' ,Rule::unique('Product_translations', 'description')->ignore($product->id ,'product_id' )]
            ];
        }
        $rules += [
            'image' => ['image'],
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->errors()->getMessages());
        }

        $request_data = $request->except(['image']);

        if($request->hasFile('image')){
            if($product->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/products/'.$product->image);

            }
            Image::make($request->file('image'))
                ->resize(100,null , function ($constraint){
                    $constraint->aspectRatio();
                })->save('uploads/products/' . $request->file('image')->hashName(), 80);
            $request_data['image'] = $request->file('image')->hashName();

        }
        $product->update($request_data);
        alert()->success(__('site.success_job'),__('site.updated_successfully'));
        return redirect('/dashboard/products');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->image != 'default.png'){
            Storage::disk('public_uploads')->delete('/users/'.$product->image);
        }
        $product->delete();
        alert()->success(__('site.success_job'),__('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');
    }
}
