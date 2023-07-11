<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Models\User;
use Spatie\Tags\Tag;

class CommandPostService
{
    private readonly Post $post;

    public function __construct(
        private readonly User $auth
    ) {}

    public function store(array $data): void
    {
        $tagIds = [];

        foreach ($data['tags'] ?? [] as $tags) {
            foreach ($tags as $locale => $tag) {
                $tagIds[] = Tag::findOrCreateFromString($tag, 'post', $locale)?->id;
            }
        }

        $post = Post::create($data);
        $post->tags()->attach($tagIds);

        $this->post = $post;
    }

    public function update(int $id, array $data): void
    {
        $tagIds = [];

        foreach ($data['tags'] ?? [] as $tags) {
            foreach ($tags as $locale => $tag) {
                $tagIds[] = Tag::findOrCreateFromString($tag, 'post', $locale)?->id;
            }
        }

        $post = Post::findOrFail($id);
        $post->update($data);
        $post->tags()->sync($tagIds);

        $this->post = $post;
    }

    public function delete(int $id): void
    {
        $post = Post::findOrFail($id);
        $post->delete();
    }

    public function post(): Post
    {
        return $this->post;
    }
}
