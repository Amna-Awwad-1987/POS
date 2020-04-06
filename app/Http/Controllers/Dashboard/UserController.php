<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:edit_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }

    public function index(Request $request)
    {

            $users = User::whereRoleIs('admin')->when($request->search, function($query) use($request){
                return $query->where('first_name', 'like', '%'. $request->search . '%')
                    ->orWhere('last_name', 'like' , '%'. $request->search . '%');
            })->latest()->paginate(4);

        return view('dashboard.users.index',compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
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
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'unique:users', 'max:255'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'image' => ['image'],
            'password' => ['required', 'confirmed'],
            'permissions'=> ['required','min:1']

        ]);
//        dd($validator->errors()->getMessages());
//        if ($validator->fails()){
//            return back()->with('error', $validator->errors()->getMessages())->withInput();
//        }
        if ($validator->fails()) {

            return Redirect::back()->withInput()->withErrors($validator->errors()->getMessages());
        }

        $request_data = $request->except(['password','password_confirmation','permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);

        if($request->hasFile('image')){
             Image::make($request->file('image'))
                ->resize(100,null , function ($constraint){
                    $constraint->aspectRatio();
                })->save('uploads/users/' . $request->file('image')->hashName(), 80);
            $request_data['image'] = $request->file('image')->hashName();
        }


//        dd($request_data['image']);
        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        alert()->success(__('site.success_job'),__('site.added_successfully'));
//        session()->flash('success',__('site.added_successfully'));
        return redirect('/dashboard/users');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => ['required',  Validation\Rule::unique('users')->ignore($user->id), 'max:255'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'image' => ['image'],
            'permissions'=> ['required','min:1']
        ]);

        $request_data = $request->except(['permissions', 'image']);
        if($request->hasFile('image')){
            if($user->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/users/'.$user->image);

            }
            Image::make($request->file('image'))
                ->resize(100,null , function ($constraint){
                    $constraint->aspectRatio();
                })->save('uploads/users/' . $request->file('image')->hashName(), 80);
            $request_data['image'] = $request->file('image')->hashName();

        }

        $user->update($request_data);
        $perm[] = $request->permissions;

        if ($request->permissions){
            $user->syncPermissions($request->permissions);
            }
        else{
           $user->syncPermissions([]);
        }
        alert()->success(__('site.success_job'),__('site.updated_successfully'));
//        session()->flash('success',__('site.updated_successfully'));
        return redirect('/dashboard/users');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->image != 'default.png'){
            Storage::disk('public_uploads')->delete('/users/'.$user->image);
        }
        $user->delete();
        alert()->success(__('site.success_job'),__('site.deleted_successfully'));
        return redirect('dashboard/users');
    }
}
