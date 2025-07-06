<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Post;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CommentPost extends Mutation
{
    protected $attributes = [
        'name' => 'commentPost',
        'description' => 'A mutation',
        'middleware' => ['auth:api'],
    ];

    public function type(): Type
    {
        return GraphQL::type('Post');
    }

    public function args(): array
    {
        return [
            'post_id' => [
                'name' => 'post_id',
                'type' => Type::nonNull(Type::int()),
            ],
            'comment' => [
                'name' => 'comment',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        $post = Post::find($args['post_id']);
        // dd($post);
        $post->comments()->create([
            'comment' => $args['comment'],
        ]);
        return $post;
    }
}
