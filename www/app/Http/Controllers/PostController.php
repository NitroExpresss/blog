<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;
    private $categoryService;

    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $posts = $this->postService->listPosts(5);
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->postService->getPostDetails($id);
        $categories = $this->categoryService->listCategoriesWithPostCount();

        return response()->json([
            'post' => $post,
            'categories' => $categories
        ]);
    }
}
