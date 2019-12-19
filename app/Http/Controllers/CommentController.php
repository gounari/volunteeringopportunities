<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function page()
    {
        return view('comments.show');
    }

    public function apiIndex()
    {
        return Comment::orderBy('created_at', 'DESC')->get();
    }

    public function apiStore(Request $request)
    {
        $validatedData = $request->validate ([
            'comment_text' => 'required|max:225',
            'post_id' => 'required',
            'user_id' => 'required',
        ]);

        $comment = new Comment;
        $comment->comment_text = $validatedData['comment_text'];
        $comment->post_id = $validatedData['post_id'];
        $comment->user_id = $validatedData['user_id'];
        $comment->save();

        return Comment::orderBy('created_at', 'DESC')->first();;
    }

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
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('comments.show', ['comment' => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate ([
            'comment' => 'required|max:225',
        ]);

        $comment = Comment::find($id);
        $comment->comment_text = $validatedData['comment'];
        $comment->save();
        
        return redirect()->route('posts.show', ['post' => $comment->post_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $post_id = $comment->post_id;
        $comment->delete();
        return redirect()->route('posts.show', ['post' => $post_id]);
    }
}
