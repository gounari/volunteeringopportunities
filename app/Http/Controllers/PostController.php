<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\User;
use Image;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function page() {
        return view('posts.index');
    }

    public function apiIndex()
    {
        return Post::orderBy('created_at', 'DESC')->get();
    }

    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:225',
            'country' => 'required|max:225',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|max:225',
            'application_url' => 'required|max:225',
            'user_id' => 'required',
        ]);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->country = $validatedData['country'];
        $post->start_date = $validatedData['start_date'];
        $post->end_date = $validatedData['end_date'];
        $post->description = $validatedData['description'];
        $post->application_url = $validatedData['application_url'];
        $user = User::where('id', $validatedData['user_id'])->first();
        $post->organization_id = $user->profile_id;
        $post->save();

        return Post::orderBy('created_at', 'DESC')->first();
    }

    public function comments(Post $post) {
        return Comment::orderBy('created_at', 'DESC')->where('post_id', $post->id)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::paginate(5);
        //return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
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
        $validatedData = $request->validate ([
            'title' => 'required|max:225',
            'country' => 'required|max:225',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|max:225',
            'application_url' => 'required|max:225',
            'image' => 'image|required|max:1999',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $destinationPath = public_path('/images');
            $img = Image::make($image->path());
            $img->resize(750, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$fileNameToStore);
        }

        $post = Post::find($id);
        $post->title = $validatedData['title'];
        $post->country = $validatedData['country'];
        $post->start_date = $validatedData['start_date'];
        $post->end_date = $validatedData['end_date'];
        $post->description = $validatedData['description'];
        $post->application_url = $validatedData['application_url'];
        $post->image = $fileNameToStore;
        $post->save();
        
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
