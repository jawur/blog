<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Author;
use Auth;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        // adding related comments to json response.
        foreach ($posts as $post) {
            $post->comments;
        }

        return new PostResource($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|string|max:500',
        ]);

        $post = new Post();

        $post->title = $request->title;
        $post->content = $request->content;
        $post->author_id = Author::where('user_id', Auth::user()->id)->first()->id;

        $post->save();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = Post::find($post->id);

        // adding related comments to json response.
        $post->comments;

        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return redirect(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (Author::where('user_id', Auth::user()->id)->first()->id !== $post->author_id) {
            return redirect(404);
        }

        $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|string|max:500',
        ]);

        $post = Post::find($post->id);

        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Author::where('user_id', Auth::user()->id)->first()->id !== $post->author_id) {
            return redirect(404);
        }

        $post = Post::find($post->id);

        $post->delete();
    }
}
