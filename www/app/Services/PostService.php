<?php

namespace App\Services;

use App\Repositories\PostsRepository;

class PostService
{
    private $postRepository;

    public function __construct(PostsRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function listposts(int $perPage = 10)
    {
        return $this->postRepository->getAllPaginated($perPage);
    }


    public function getPostDetail(string $slug)
    {
        return $this->postRepository->getBySlug($slug);
    }
    public function getByCategoryPaginated(string $categorySlug, int $perPage = 10)
    {
        return $this->postRepository->getByCategoryPaginated($categorySlug, $perPage);
    }
}
