<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::when($request->search, function($query) use($request){
                return $query->where('name', 'like', '%'. $request->search . '%');
            })->latest()->paginate(4);

       return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','unique:categories'],
//            'image' => ['image'],
        ]);
        if ($validator->fails()) {

            return Redirect::back()->withInput()->withErrors($validator->errors()->getMessages());
        }

//        dd($request_data);
        $category = Category::create($request->all());
        alert()->success(__('site.success_job'),__('site.added_successfully'));
        return redirect('/dashboard/categories');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
      return view('dashboard.categories.edit',compact('category'));
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
        $category = Category::find($id);
//        dd($request->all() , $category);
        $validator = Validator::make($request->all(),[
            'name' => ['required', Rule::unique('categories')->ignore($category->id),],
//            'image' => ['image'],
        ]);
        if ($validator->fails()) {

            return Redirect::back()->withInput()->withErrors($validator->errors()->getMessages());
        }
        $category->update($request->all());
        alert()->success(__('site.success_job'),__('site.updated_successfully'));
        return redirect('/dashboard/categories');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        alert()->success(__('site.success_job'),__('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');
    }
}
