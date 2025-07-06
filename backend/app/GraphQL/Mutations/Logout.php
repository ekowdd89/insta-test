<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class Logout extends Mutation
{
    protected $attributes = [
        'name' => 'logout',
        'middleware' => ['auth:api'],
    ];
    public function type(): Type
    {
        return Type::boolean();
    }


    public function resolve($root, array $args)
    {
        // dd(auth()->user());
        auth('api')->logout();
        return true;
    }
}
