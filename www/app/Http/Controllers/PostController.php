<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->listPosts(8);
        return view('posts.index', compact('posts'));
    }

    public function detail($postSlug)
    {
        $post = $this->postService->getPostDetail($postSlug);
        return view('posts.detail', compact('post'));
    }
    public function category($categorySlug)
    {
        $posts = $this->postService->getByCategoryPaginated($categorySlug,9);
        return view('posts.category', compact('posts'));
    }
}
