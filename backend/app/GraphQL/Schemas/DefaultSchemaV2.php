<?php

namespace App\GraphQL\Schemas;

use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class DefaultSchemaV2 implements ConfigConvertible
{
    public function toConfig(): array
    {
        return [
            'query' => [
                // ExampleQuery::class,
                \App\GraphQL\Queries\ExampleQuery::class,
            ],

            'mutation' => [
                // ExampleMutation::class,
            ],

            'types' => [
                // ExampleType::class,
            ],
        ];
    }
}
