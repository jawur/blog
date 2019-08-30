<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use League\Fractal\Manager;
use App\Transformers\CommentTransformer;
use League\Fractal\Resource\Collection;
use Auth;

class CommentController extends Controller
{
    private $fractal, $commentTransformer;

    public function __construct(Manager $fractal, CommentTransformer $commentTransformer)
    {
        $this->fractal = $fractal;
        $this->commentTransformer = $commentTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Comment $comments)
    {
        $comments = new Collection($comments->all(), $this->commentTransformer);
        $comments = $this->fractal->createData($comments);

        return $comments->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreRequest $request, Comment $comment)
    {
        $comment->title = $request->input('title');
        $comment->content = $request->input('content');
        $comment->post_id = $request->input('post_id');
        $comment->user_id = Auth::user()->id;

        $comment->save();

        return fractal($comment, $this->commentTransformer)->toArray();
    }

    public function show(Comment $comment)
    {
        return fractal($comment, $this->commentTransformer)->toArray();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->title = $request->input('title');
        $comment->content = $request->input('content');

        $comment->save();

        return fractal($comment, $this->commentTransformer)->toArray();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response(null, 204);
    }
}
