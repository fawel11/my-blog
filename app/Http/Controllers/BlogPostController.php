<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostRequest;
use App\Http\Resources\BlogPostResource;
use App\Models\BlogPost;
use Auth;
use Illuminate\Http\Request;
use App\Interfaces\BlogPostRepositoryInterface;

class BlogPostController extends Controller
{

    private $blogPostRepository;

    public function __construct(BlogPostRepositoryInterface $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $posts = $this->blogPostRepository->getAllBlogs(); //fetch all blog posts from DB
        } else {
            $posts = $this->blogPostRepository->getMyBlogs(); //fetch all blog posts from DB

        }
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }


    public function store(BlogPostRequest $request)
    {
        $newPost = BlogPost::createPost($request->all());

        if ($newPost) {
            return redirect()->route('posts.index')->with('success', 'Post created successfully');
        }
        return redirect()->back()->with('error', 'Whoops!!');

    }

    public function show($id)
    {

        $post = $this->blogPostRepository->getBlogById($id);

        if (!$post->isTheOwner(Auth::user())) return redirect()->back()->with('error', 'Whoops!!');

        return view('posts.show', compact('post'));
    }


    public function edit($postId)
    {
        $post = $this->blogPostRepository->getBlogById($postId);
        if (!$post->isTheOwner(Auth::user())) return redirect()->back()->with('error', 'Whoops!!');

        return view('posts.edit', compact('post'));

    }


    public function update(BlogPostRequest $request, $postId)
    {

        if ($this->blogPostRepository->updateBlog($postId, $request->input())) {
            return redirect()->route('posts.index')->with('success', 'Post updated successfully');
        }

        return redirect()->back()->with('error', 'Whoops!!');
    }


    public function destroy($blogId)
    {
        if ($this->blogPostRepository->deleteBlog($blogId)) {
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        }
        return redirect()->back()->with('error', 'Whoops!!');
    }
}
