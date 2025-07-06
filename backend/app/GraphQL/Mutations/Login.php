<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class Login extends Mutation
{
    protected $attributes = [
        'name' => 'login',
    ];

    public function type(): Type
    {
        return GraphQL::type('AuthResponse');
    }

    public function args(): array
    {
        return [
            'email' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        $credential = [
            'email' => $args['email'],
            'password' => $args['password'],
        ];
        if (!$token = Auth::attempt($credential)) {
            throw new \Exception("Invalid Credemtial");
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => Auth::user(),
        ];
    }
}
