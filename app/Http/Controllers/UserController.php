<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\User;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.show');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$user = User::find($id);
        $user = auth()->user()->find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user($id);
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'          => 'required|max:255',
            'email'         => ['required',Rule::unique('users')->ignore(Auth::user()->id),
        ],
            'password'      => 'nullable|min:6',
            'profile_image' => 'image|nullable|max:1999|mimes:jpeg,bmp,png'
        ]);

        //handle image
        if($request->hasFile('profile_image')){
            $imageNameWithExt = $request->file('profile_image')->getClientOriginalName();
            $imageName         = pathinfo($imageNameWithExt, PATHINFO_FILENAME);
            $extension        = $request->file('profile_image')->getClientOriginalExtension();
            $imageNameToStore = $imageName . '_' . time() . '.' . $extension;
            $path             = $request->file('profile_image')->storeAs('public/profile_images', $imageNameToStore);    
        }

        //update user
        $user = Auth::user($id);
        $user->name  = $request->input('name');
        $user->email = $request->input('email');
        if($request->hasFile('profile_image')){
            $user->profile_image = $imageNameToStore;
        }
        if($request->input('password')){
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        return redirect('/user/'.Auth::user()->id)->with('success', 'User Updated Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
