<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class MediaType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Media',
        'description' => 'A type',
        'model' => \App\Models\Media::class,
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
            ],
        ];
    }
}
