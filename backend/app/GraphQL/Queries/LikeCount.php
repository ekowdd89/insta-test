<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Post;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class LikeCount extends Query
{
    protected $attributes = [
        'name' => 'likeCount',
        'description' => 'A query',
        'model' => \App\Models\Post::class
    ];

    public function type(): Type
    {
        return Type::listOf(Type::int());
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $posts = Post::find($args['post_id']);
        $count = $posts->likes()->count();
        return $count;
    }
}
