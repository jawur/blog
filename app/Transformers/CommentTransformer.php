<?php
namespace App\Transformers;

use App\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    public function transform(Comment $comment)
    {
        return [
            'data' => [
                'id' => (int) $comment->id,
                'title' => $comment->title,
                'content' => $comment->content,
                'user_id' => (int) $comment->user_id,
                'post_id' => (int) $comment->post_id,
            ],
            'meta' => [],
        ];
    }
}
