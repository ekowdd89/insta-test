<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class MediaInputType extends GraphQLType
{
    protected $attributes = [
        'name' => 'MediaInput',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::ID()),
            ],
            'url' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'type' => [
                'type' => Type::nonNull(Type::string()),
            ]
        ];
    }
}
