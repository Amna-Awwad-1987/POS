<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $clients = Client::when($request->search, function($query) use($request ){

            return $query->whereTranslationLike( 'name', '%'. $request->search . '%')
//                ->orWhere('address', 'like', '%'. $request->search . '%')
            ->orWhere('mobile', 'like' , '%'. $request->search . '%');

        })->latest()->paginate(4);

        return view('dashboard.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.create');
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
        $rules = [];

        foreach (config('translatable.locales') as $locale){
            $rules += [ $locale . '.name'=> ['required'],
                $locale . '.address'=> ['required']
            ];
        }
        $rules += [
            'mobile' => ['required' ,'min:1' ,Rule::unique('clients', 'mobile'),
                ]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->errors()->getMessages());
        }
        $request_data = $request->all();
        $client = Client::create($request_data);
        alert()->success(__('site.success_job'),__('site.added_successfully'));
        return redirect('/dashboard/clients');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Client $client)
    {
        return view('dashboard.clients.edit',compact('client'));
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
        $client = Client::find($id);
        $rules = [];

        foreach (config('translatable.locales') as $locale){
            $rules += [ $locale . '.name'=> ['required'],
                $locale . '.address'=> ['required']
            ];
        }
        $rules += [
            'mobile' => ['required','min:1' ,Rule::unique('clients', 'mobile')->ignore($client->id , 'id'),
            ]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->errors()->getMessages());
        }

        $request_data = $request->all();
        $client->update($request_data);
        alert()->success(__('site.success_job'),__('site.updated_successfully'));
        return redirect('/dashboard/clients');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        
        $client->delete();
        alert()->success(__('site.success_job'),__('site.deleted_successfully'));
        return redirect()->route('dashboard.clients.index');
    }
}
