<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Category;

class PostsRepository
{
    public function getAllPaginated(int $perPage = 10)
    {
        return Post::with('category')->paginate($perPage)->withPath('https://nitroexpress.space/posts');
    }

    public function getByCategoryPaginated(string $categorySlug, int $perPage = 10)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $posts = Post::with('category')
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            })
            ->paginate($perPage)
            ->withPath("https://nitroexpress.space/posts/{$categorySlug}");
        return ['category' => $category, 'posts' => $posts];
    }


    public function getById(int $id)
    {
        return Post::with('category')->find($id);
    }
    public function getBySlug(string $slug)
    {

        $post = Post::with('category')->where('slug', $slug)->firstOrFail();
        $relatedPosts = Post::where('category_id', $post->category_id)
        ->inRandomOrder()
        ->limit(3)
        ->get();
        return ['related' => $relatedPosts, 'post' => $post];
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
