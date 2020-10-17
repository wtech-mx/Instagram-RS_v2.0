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
                           class="form-control "
                           name="name"
                           id="name"
                           placeholder="name"
                          value="{{$profile->User->name}}"
                    >

                @if ($errors->has('name'))
                	<span class="text-danger">{{ $errors->first('name') }}</span>
            	@endif

                </div>

                <div class="form-group mt-3">

                    <label for="biography">Biography</label>

                    <input type="text"
                           class="form-control"
                           name="biography"
                           id="biography"
                           placeholder="biography"
                             value="{{$profile->biography}}"
                    >

                @if ($errors->has('biography'))
                	<span class="text-danger">{{ $errors->first('biography') }}</span>
            	@endif

                </div>

                <div class="form-group mt-3">

                    <label for="img">Image</label>
                    <input type="file"
                            id="img"
                           class="form-control"
                           name="img"
                    >
                    @if ($errors->has('img'))
                        <span class="text-danger">{{ $errors->first('img') }}</span>
                    @endif

                    @if($profile->img)
                        <div class="mt-4">
                            <p>Imagen actual</p>
                            <img class="card-img" src="{{asset('upload-img/'.$profile->img)}}" alt="{{$profile->img}}" style="width: 300px">
                        </div>



                    @endif
                </div>

            </form>
        </div>
    </div>

@endsection
