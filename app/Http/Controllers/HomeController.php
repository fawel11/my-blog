<?php

namespace App\Http\Controllers;

use App\Interfaces\BlogPostRepositoryInterface;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class HomeController extends Controller
{


    private $blogPostRepository;

    public function __construct(BlogPostRepositoryInterface $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }

    public function index()
    {
        $posts = $this->blogPostRepository->getAllBlogs();
        $postId= $posts->keys()->random();

        return view('public.home', compact('posts','postId'));
    }

    public function details($title)
    {
        $post =  $this->blogPostRepository->getBlogByTitle($title);
        return view('public.details', compact('post'));
    }
}
