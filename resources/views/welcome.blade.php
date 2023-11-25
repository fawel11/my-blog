
@extends('layouts.public')

@section('content')
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Blog Home!</h1>
            <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            @if($postId)

                <div  class="card mb-4">
                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                                      alt="..."/></a>
                    <div class="card-body">
                        <div class="small text-muted">{{ $posts[$postId]->created_at->format('D M Y H:i:s') }}</div>
                        <h2 class="card-title">{{$posts[$postId]->title}}</h2>
                        <p class="card-text"> {!!  Str::limit($posts[$postId]->body, 180)  !!}</p>
                        <a class="btn btn-primary" href="{{route('home.details',$posts[$postId]->title)}}">Read more
                            →</a>
                    </div>
                </div>
            @endif

            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                @foreach ($posts as $key => $post)
                    <div class="col-lg-6">
                        <!-- Blog post-->
                        <div class="card mb-4">
                            <a href="#!"><img class="card-img-top"
                                              src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"
                                              alt="..."/></a>
                            <div class="card-body">
                                <div class="small text-muted"><small
                                        class="text-muted">{{ $post->created_at->diffForHumans() }}</small></div>
                                <h2 class="card-title h4">{{$post->title}}</h2>
                                <p class="card-text">
                                    {!!  Str::limit($post->body, 80)  !!}
                                </p>
                                <a class="btn btn-primary" href="{{route('home.details',$post->title)}}">Read more →</a>
                            </div>
                        </div>

                    </div>

                @endforeach
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                <hr class="my-0"/>
                <ul class="pagination justify-content-center my-4">
                    {!! $posts->links() !!}
                </ul>
            </nav>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..."
                               aria-label="Enter search term..." aria-describedby="button-search"/>
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">Web Design</a></li>
                                <li><a href="#!">HTML</a></li>
                                <li><a href="#!">Freebies</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">JavaScript</a></li>
                                <li><a href="#!">CSS</a></li>
                                <li><a href="#!">Tutorials</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use,
                    and feature the Bootstrap 5 card component!
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

