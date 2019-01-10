<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required',
            'body'          => 'required',
            'cover_image'   => 'image|nullable|max:1999|mimes:jpeg,bmp,png'
        ]);
        

        //handle file upload
        if($request->hasFile('cover_image')){
            //Get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            //Get Filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //Filename To Store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }
        //create Post
        $post = new Post;
        $post->title        = $request->input('title');
        $post->body         = $request->input('body');
        $post->cover_image  = $fileNameToStore;
        $post->user_id      = auth()->user()->id;
        $post->save();
        return redirect('/posts')->with('success', 'Post Added Successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = Post::find($post->id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post = Post::find($post->id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title'         => 'required',
            'body'          => 'required',
            'cover_image'   => 'image|nullable|max:1999'
        ]);

        //handle file upload
        if($request->hasFile('cover_image')){
            //Get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            //Get Filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //Filename To Store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        //create Post
        $post = Post::find($post->id);
        $post->title       = $request->input('title');
        $post->body        = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->user_id = Auth()->user()->id;
        $post->save();
        return redirect('/posts')->with('success', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post = Post::find($post->id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        if($post->cover_image != 'noimage.jpg'){
            Storage::delete('storage/cover_images/'. $post->cover_images);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted Successfully');
    }
}
