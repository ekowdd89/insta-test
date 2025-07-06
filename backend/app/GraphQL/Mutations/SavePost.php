<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Post;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class SavePost extends Mutation
{
    protected $attributes = [
        'name' => 'savePost',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return Type::listOf(Type::string());
    }

    public function args(): array
    {
        return [
            'caption' => [
                'name' => 'caption',
                'type' => Type::nonNull(Type::string()),
            ],
            'media' => [
                'name' => 'media',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $post = Post::create([
            'user_id' => $args['user_id'],
            'caption' => $args['caption'],
        ]);

        return $post;
    }
}
