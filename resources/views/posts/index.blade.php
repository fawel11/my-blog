@extends('layouts.admin')

@section('content')

    <div class="container shadow bg-light mt-3 p-3 ">
        <div class="row">
            <div class="row margin-tb">
                <div class="col-sm-9">
                    <h3>All Blog Posts</h3>
                </div>
                <div class="col-sm-3">
                    <a class="btn btn-primary" href="{{ route('posts.create') }}"> Add blog Details</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 table-responsive">
                @if ($message = Session::get('success'))
                    <div class="alert alert-primary card shadow">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <table class="table table-bordered table-hover">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Author</th>
                        <th>Created at</th>
                        <th width="230px">Actions</th>
                    </tr>
                    @foreach ($posts as $key => $post)
                        <tr>
                            <td>{{ ++$key }}</td>

                            <td>{{ $post->title }}</td>
                            <td>{!! Str::limit($post->body), 50 !!}</td>
                            <td>{{ $post->authorName }}</td>
                            <td><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></td>
                            <td class="shadow">

                                <form id="delete-form-{{ $post->id }}" method="post"
                                      action="{{ route('posts.destroy', $post->id) }}" style="display: none">
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}
                                </form>
                                <a class="btn btn-success btn-sm" href="{{ route('posts.show',$post->id) }}"><i
                                        class="fa-solid fa-eye"></i> View</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('posts.edit',$post->id) }}"><i
                                        class="fa-solid fa-pen-to-square"></i> Edit</a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="
                                    if(confirm('Are you sure, You want to Delete this ??'))
                                    {
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $post->id }}').submit();
                                    }"><i class="fa-solid fa-trash-can"></i> Delete
                                </a>
                            </td>
                        </tr>

                    @endforeach

                </table>

                    <div class="d-flex">
                        {!! $posts->links() !!}
                    </div>
            </div>
        </div>
    </div>
@endsection
