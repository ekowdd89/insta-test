<?php

declare(strict_types=1);

namespace App\GraphQL\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use GraphQL\Type\Definition\ResolveInfo;

class DynamicAuthMiddleware
{
    public function handle($root, $args, $context, ResolveInfo $resolveInfo, Closure $next)
    {
        $excluded = ['allPosts', 'postById'];

        if (!in_array($resolveInfo->fieldName, $excluded) && !Auth::check()) {
            throw new \Exception('Unauthenticated');
        }

        return $next($root, $args, $context, $resolveInfo);
    }
}
