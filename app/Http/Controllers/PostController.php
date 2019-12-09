<?php

namespace App\Http\Controllers;

use App\Organization;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::all();
        $users = [];
        foreach ($organizations as $organization) {
            array_push($users, $organization->user->name);
        }
        $names = collect($users)->sort()->toArray();

        return view('posts.create', ['organizations' => $names]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:225',
            'country' => 'required|max:225',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|max:225',
            'application_url' => 'required|max:225',
            'organization_id' => 'required|integer',
        ]);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->country = $validatedData['country'];
        $post->start_date = $validatedData['start_date'];
        $post->end_date = $validatedData['end_date'];
        $post->description = $validatedData['description'];
        $post->application_url = $validatedData['application_url'];
        $post->organization_id = $validatedData['organization_id'];
        $post->save();

        session()->flash('message', 'Post was created.');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
