@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-12 mb-3">
            <div class="card mb-4 bg-gray-200 shadow-sm">
                <div class="card-body">
                    <div class="author text-black">
                        <h2>{{ $post->title }}</h2>
                        <div class="text-black-50">
                            Posted By: <a href="#">{{ optional($post->user)->name }}</a>
                            {{ $post->created_at->format('m/d/Y h:m a') }}

                        </div>
                    </div>

                    <div class="post-body text-black">
                        {!! $post->body !!}
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-primary btn-sm" href="{{ route('posts.edit',$post->id) }}"><i
                            class="fa-solid fa-pen-to-square"></i> Edit</a>
                </div>

            </div>
        </div>
    </div>
@endsection
