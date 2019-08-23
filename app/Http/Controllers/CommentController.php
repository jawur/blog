<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use App\Transformers\CommentTransformer;
use League\Fractal\Resource\Collection;

class CommentController extends Controller
{

    private $fractal, $commentTransformer;

    public function __construct(Manager $fractal, CommentTransformer $commentTransformer)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);

        $this->fractal = $fractal;
        $this->commentTransformer = $commentTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        $comments = new Collection($comments, $this->commentTransformer);
        $comments = $this->fractal->createData($comments);
        return $comments->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|string|max:500',
            'post_id' => 'required|integer',
        ]);

        $comment = new Comment();

        $comment->title = $request->title;
        $comment->content = $request->content;
        $comment->post_id = (int)$request->post_id;
        $comment->user_id = Auth::user()->id;

        $comment->save();
    }

    public function show(Comment $comment)
    {
        $comment = fractal($comment, CommentTransformer::class);

        return $comment->toArray();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if (Auth::user()->id !== $comment->user_id) {
            return redirect(404);
        }

        $data = $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|string|max:500',
        ]);

        $comment = Comment::find($comment->id);

        $comment->title = $request->title;
        $comment->content = $request->content;

        $comment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if (Auth::user()->id !== $comment->user_id) {
            return redirect(404);
        }

        $comment = Comment::find($comment->id);

        $comment->delete();
    }
}
