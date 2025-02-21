<?php

namespace App\Repositories;

use App\Models\Post;

class PostsRepository
{
    public function getAllPaginated(int $perPage = 10)
    {
        return Post::with('category')->paginate($perPage)->withPath('https://nitroexpress.space/posts');
    }

    public function getById(int $id)
    {
        return Post::with('category')->find($id);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update(Post $post, array $data)
    {
        $post->update($data);
        return $post;
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }
}
