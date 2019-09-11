<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Post;
use App\Author;
use Auth;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\Tag as TagResource;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $posts)
    {
        return PostResource::collection($posts->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request, Post $post)
    {
        $author = Author::create([
            'user_id' => Auth::user()->id,
        ]);

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->author_id = $author->id;

        $post->save();

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return PostResource::collection($post->find($post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->title = $request->input('title');
        $post->content = $request->input('content');

        $post->save();

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response(null, 204);
    }

    public function tags(Post $post)
    {
        return new TagResource($post->find($post)->first()->tags);
    }
}
