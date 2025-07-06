<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'A type',
        'model' => \App\Models\Post::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::ID()),
            ],
            'caption' => [
                'type' => Type::string(),
            ],
            'user' => [
                'type' => GraphQL::type('User')
            ],
            'media' => [
                'type' => Type::listOf(GraphQL::type('Media')),
                'resolve' => fn($root) => $root->media
            ],
            'comments' => [
                'type' => Type::listOf(GraphQL::type('Comment')),
                'resolve' => fn($post) => $post->comments
            ],
            'likes' => [
                'type' => Type::listOf(GraphQL::type('Like')),
                'resolve' => fn($post) => $post->likes
            ]
        ];
    }
    public function resolveMediaField($root)
    {
        return $root->media;
    }
}
