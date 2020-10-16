@extends('layouts.app')

@section('content')

    <h1 class="text-center">Edit  Profile </h1>

    <div class="row justify-content-center">
        <div class="col-md-10 bg-white p-3">
            <form action="{{route('profile.update',['profile' => $profile->id])}}" method="POST" enctype="multipart/form-data" >
                @csrf
                @method('PUT')

                <div class="d-flex flex-row-reverse">
                    <div class="form-group">
                        <input type="submit" class="btn btn-sm btn-primary" value="Update Profile">
                    </div>
                </div>

                <div class="form-group">

                    <label for="nombre">Name</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           id="name"
                           placeholder="name"
                          value="{{$profile->User->name}}"
                    >

                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group mt-3">

                    <label for="biography">Biography</label>

                    <input type="text"
                           class="form-control @error('biography') is-invalid @enderror"
                           name="biography"
                           id="biography"
                           placeholder="biography"
                             value="{{$profile->biography}}"
                    >

                    @error('biography')
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

                    @if($profile->img)
                        <div class="mt-4">
                            <p>Imagen actual</p>
                            <img class="card-img" src="{{asset('upload-img/'.$profile->img)}}" alt="{{$profile->img}}" style="width: 300px">
                        </div>

                        @error('img')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    @endif
                </div>

            </form>
        </div>
    </div>

@endsection
