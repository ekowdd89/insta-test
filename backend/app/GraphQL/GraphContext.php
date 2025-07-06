<?php

namespace App\GraphQL;

use Illuminate\Support\Facades\Request;

class GraphContext
{
    public function __invoke(Request $request)
    {
        return [
            'user' => auth('api')->user(),
        ];
    }
}
