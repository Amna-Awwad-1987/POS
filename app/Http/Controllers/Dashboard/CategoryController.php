<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\CategoryTranslation;
use App\Http\Controllers\Controller;
use GuzzleHttp;
use http\Client;
use http\QueryString;
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

        $categories = Category::when($request->search, function($q) use($request ){
            return $q->when($request->search, function($query) use($request) {

                return $query->whereTranslationLike('name', '%' . $request->search . '%');

            });
            })->latest()->paginate(5);

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
        $rules = [];
        foreach (config('translatable.locales') as $locale){
            $rules += [ $locale . '.name'=> ['required' ,Rule::unique('category_translations', 'name')]];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->errors()->getMessages());
        }

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

        $rules = [];
        foreach (config('translatable.locales') as $locale){
           $rules += [$locale . '.name'=> ['required', Rule::unique('category_translations', 'name')->ignore($category->id , 'category_id')]];
        }
        $validator = Validator::make($request->all(), $rules);

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

    public function image_editor(){


        $client = new GuzzleHttp\Client();
        $request = new Client\Request();

        $request->setRequestUrl('https://pixelixe.p.rapidapi.com/docs/');
        $request->setRequestMethod('GET');
        $request->setQuery(new QueryString(array(
            'apikey' => '<required>'
        )));

        $request->setHeaders(array(
            'x-rapidapi-host' => 'pixelixe.p.rapidapi.com',
            'x-rapidapi-key' => 'f6e0338d98msh45ed1f4718aca3ep15f28fjsnba222abad1d4'
        ));

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

}
