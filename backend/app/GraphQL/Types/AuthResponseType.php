<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class AuthResponseType extends GraphQLType
{
    protected $attributes = [
        'name' => 'AuthResponse',
    ];

    public function fields(): array
    {
        return [
            'access_token' => [
                'type' => Type::string(),
            ],
            'token_type' => [
                'type' => Type::string(),
            ],
            'expires_in' => [
                'type' => Type::int(),
            ],
            'user' => [
                'type' => GraphQL::type('User'),
            ],
        ];
    }
}
