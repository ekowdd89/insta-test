<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;


class Post extends Query
{
    protected $attributes = [
        'name' => 'allPosts',
        'description' => 'A query',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Post'));
    }

    public function args(): array
    {
        return [];
    }
    public function resolve($root, array $args)
    {

        $posts = \App\Models\Post::with([
            'user',
            'media',
        ])->get();
        return $posts;
    }
}
