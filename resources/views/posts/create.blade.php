@extends('layouts.app')

@section('content')

    <h1 class="text-center mb-2">Create post</h1>

    <div class="row justify-content-center p-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('posts.store')  }}" novalidate enctype="multipart/form-data">
                @csrf

                <div class="d-flex flex-row-reverse">
                    <div class="form-group">
                        <input type="submit" class="btn btn-sm btn-primary" value="Compartir">
                    </div>
                </div>

                <div class="form-group">

                    <label for="title">Post title</label>
                    <input type="text"
                           class="form-control"
                           name="title"
                           id="title"
                           placeholder="Post title"
                           value="{{old('title')}}"
                    >
                @if ($errors->has('title'))
                	<span class="text-danger">{{ $errors->first('title') }}</span>
            	@endif

                </div>

                <div class="form-group">
                    <label for="post_id">Category</label>

                    <select name="post_id"
                            id="post_id"
                            class="form-control "
                    >
                @if ($errors->has('post_id'))
                	<span class="text-danger">{{ $errors->first('post_id') }}</span>
            	@endif
                        <option value="">- Select -</option>

                        @foreach($post as $post)

                            <option value="{{$post->id}}"
                                {{ old('post') == $post->id ? 'selected' : ''}} >
                                {{$post->name}}</option>
                       @endforeach
                    </select>

                </div>

                <div class="form-group mt-3">

                    <label for="description">Write caption</label>

                    <input type="text"
                           class="form-control"
                           name="description"
                           id="description"
                           placeholder="Post title"
                           value="{{old('description')}}"
                    >
                @if ($errors->has('description'))
                	<span class="text-danger">{{ $errors->first('description') }}</span>
            	@endif

                </div>

                <div class="form-group mt-3">

                    <label for="img">Image</label>
                    <input type="file"
                            id="img"
                           class="form-control "
                           name="img"
                    >
                @if ($errors->has('img'))
                	<span class="text-danger">{{ $errors->first('img') }}</span>
            	@endif

                </div>


            </form>
        </div>
    </div>

@endsection
