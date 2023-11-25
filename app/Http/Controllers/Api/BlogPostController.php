<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Interfaces\BlogPostRepositoryInterface;
use App\Models\BlogPost;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BlogPostController extends Controller
{
    private $blogPostRepository;

    public function __construct(BlogPostRepositoryInterface $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }

    public function index()
    {
        try {

            if (auth()->user()->isAdmin()) {
                $posts = $this->blogPostRepository->getAllBlogs(); //fetch all blog posts from DB
            } else {
                $posts = $this->blogPostRepository->getMyBlogs(); //fetch all blog posts from DB

            }
            return response()->json($posts, 200);

        } catch (ModelNotFoundException $ex) {
            return response()->json(['message' => 'The Model Not Found!'], 405);

        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 405);
        }
    }


    public function store(BlogPostRequest $request)
    {
        try {
            $newPost = BlogPost::createPost($request->all());

            if ($newPost) {
                return response()->json(['message' => 'Post created successfully']);
            }
        } catch (ValidationException $exception) {
            return response()->json(['message' => $exception->getMessage(), 'errors' => $exception->validator->getMessageBag()->toArray()], 422);
        }

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
