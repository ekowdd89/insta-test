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

class LikePost extends Mutation
{
    protected $attributes = [
        'name' => 'likePost',
        'description' => 'A mutation',
        'middleware' => ['auth:api'],
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'post_id' => [
                'type' => Type::nonNull(Type::ID()),
            ],
            'liked' => [
                'type' => Type::boolean(),
            ]
        ];
    }

    public function resolve($root, array $args)
    {
        $post = Post::find($args['post_id']);
        if ($post->likes()->where('user_id', auth('api')->user()->id)->exists()) {
            $post->likes()->where('user_id', auth('api')->user()->id)->update([
                'liked' => (bool)$args['liked'],
            ]);
            return 'Post' . ((bool)$args['liked'] ? ' Liked' : ' Disliked');
        }
        $post->likes()->create([
            'user_id' => auth('api')->user()->id,
            'liked' => $args['liked'],
        ]);

        return 'Post Liked';
    }
}
