<?php

namespace App\Repositories;

use App\Interfaces\BlogPostRepositoryInterface;
use App\Models\BlogPost;

class BlogPostRepository implements BlogPostRepositoryInterface
{

    public function getAllBlogs($paginate = 5)
    {
        return BlogPost::paginate($paginate);
    }

    public function getMyBlogs($paginate = 5)
    {
        return BlogPost::where('user_id', auth()->user()->id)->paginate($paginate);
    }


    public function getBlogById($blogId)
    {
        return BlogPost::findOrFail($blogId);
    }

    public function getBlogByTitle($title)
    {
        return BlogPost::where('title', $title)->first();
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
