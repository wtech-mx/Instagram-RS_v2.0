@extends('layouts.app')

@section('content')

    <h1 class="text-center mb-2">Edit post</h1>

    <div class="row justify-content-center p-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('posts.update',$post->id)  }}" novalidate enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="d-flex flex-row-reverse">
                    <div class="form-group">
                        <input type="submit" class="btn btn-sm btn-primary" value="Compartir">
                    </div>
                </div>

                <div class="form-group">

                    <label for="title">Post title</label>
                    <input type="text"
                           class="form-control @error('title') is-invalid @enderror"
                           name="title"
                           id="title"
                           placeholder="Post title"
                           value="{{$post->title}}"
                    >

                    @error('title')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="post_id">Category</label>

                    <select name="post_id"
                            id="post_id"
                            class="form-control @error('post_id') is-invalid @enderror"
                    >
                        <option value="">- Select -</option>

                        @foreach($category as $category)
                            <option value="{{$category->id}}"
                                {{ $post->post_id == $category->id ? 'selected' : ''}} >
                                {{$category->name}}
                            </option>
                       @endforeach
                    </select>

                    @error('post_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group mt-3">

                    <label for="description">Write caption</label>

                    <input type="text"
                           class="form-control @error('description') is-invalid @enderror"
                           name="description"
                           id="description"
                           placeholder="Post title"
                           value="{{$post->description}}"
                    >

                    @error('description')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group mt-3">

                    <label for="img">Image</label>
                    <input type="file"
                            id="img"
                           class="form-control @error('img') is-invalid @enderror"
                           name="img"
                    >
                    <div class="mt-4">
                        <p>Current image</p>
                        <img src="{{asset('upload-img/'.$post->img)}}" style="width: 300px">
                    </div>

                    @error('img')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>


            </form>
        </div>
    </div>

@endsection

