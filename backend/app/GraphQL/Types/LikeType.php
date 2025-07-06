<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class LikeType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Like',
        'description' => 'A type',
        'model' => \App\Models\Like::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::ID()),
            ],
            'post_id' => [
                'type' => Type::nonNull(Type::ID()),
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::ID()),
            ],
            'liked' => [
                'type' => Type::boolean(),
            ],
            // 'post' => [
            //     'type' => GraphQL::type('Post'),
            //     // 'resolve' => fn($like) => $like->post
            // ]
        ];
    }
}
