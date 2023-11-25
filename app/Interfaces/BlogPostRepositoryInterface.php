<?php

namespace App\Interfaces;

interface BlogPostRepositoryInterface
{
    public function getAllBlogs();
    public function getBlogById($blogId);
    public function deleteBlog($blogId);
    public function createBlog(array $blogDetails);
    public function updateBlog($blogId, array $newDetails);

}
