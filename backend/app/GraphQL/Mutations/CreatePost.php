<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Post;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreatePost extends Mutation
{
    protected $attributes = [
        'name' => 'createPost',
        'description' => 'A mutation',
        'middleware' => ['auth:api'],
    ];

    public function type(): Type
    {
        return GraphQL::type('Post');
    }

    public function args(): array
    {
        return [
            'caption' =>  [
                'name' => 'caption',
                'type' => Type::nonNull(Type::string())
            ],
            'media' => [
                'type' => Type::listOf(GraphQL::type('Upload')),
                'name' => 'media',
                'rules' => ['nullable', 'array'],
            ]
        ];
    }


    public function resolve($root, array $args)
    {
        $post = Post::create([
            'caption' => $args['caption'],
        ]);
        if (!empty($args['media'])) {
            $savedMedia = [];

            foreach ($args['media'] as $uploadedFile) {
                $path = $uploadedFile->store('uploads', 'public');

                $savedMedia[] = [
                    'url' => asset('storage/' . $path),
                    'type' => $this->determineMediaType($uploadedFile->getClientMimeType()),
                ];
            }

            $post->media()->createMany($savedMedia);
        }

        return $post;
    }
    protected function determineMediaType(string $mime): string
    {
        return str_starts_with($mime, 'image/') ? 'image' : (str_starts_with($mime, 'video/') ? 'video' : 'unknown');
    }
}
