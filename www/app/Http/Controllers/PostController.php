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

    public function detail($slug)
    {
        $post = $this->postService->getPostDetails($id);
        $categories = $this->categoryService->listCategoriesWithPostCount();

        return response()->json([
            'post' => $post,
            'categories' => $categories
        ]);
    }
}
