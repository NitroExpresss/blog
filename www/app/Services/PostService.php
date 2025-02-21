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


    public function getpostDetails(int $id)
    {
        return $this->postRepository->getById($id);
    }
    public function listPostsByCategory(string $categorySlug, int $perPage = 10)
    {
        return $this->postRepository->getByCategory($categorySlug, $perPage);
    }
}
