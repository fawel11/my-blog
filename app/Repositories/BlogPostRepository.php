<?php

namespace App\Repositories;

use App\Interfaces\BlogPostRepositoryInterface;
use App\Models\BlogPost;

class BlogPostRepository implements BlogPostRepositoryInterface
{

    public function getAllBlogs()
    {
        return BlogPost::get();
    }
    public function getMyBlogs()
    {
        return BlogPost::where('user_id',auth()->user()->id)->get();
    }

    public function getBlogById($blogId)
    {
        return BlogPost::findOrFail($blogId);
    }

    public function deleteBlog($blogId)
    {
        BlogPost::destroyBlog($blogId);
    }

    public function createBlog(array $blogDetails)
    {
        return BlogPost::createPost($blogDetails);
    }

    public function updateBlog($id, array $newDetails)
    {
        return BlogPost::updatePost($id, $newDetails);
    }

    public function getWithTrashBlogs()
    {
        return BlogPost::withTrashed()->get();
    }

}
