<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class TagTrasformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform()
    {
        return [
            'data' => [
                'id' => (int) $comment->id,
                'name' => $comment->title,
            ],
            'meta' => [],
        ];
    }
}
