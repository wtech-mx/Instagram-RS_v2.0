@extends('layouts.app')

@section('content')

                <div class="container-fluid p-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="text-center">
                                        <img class="rounded-circle" src="{{asset('upload-img/'.$profile->img)}}" style="width: 60%">
                                    </p>
                                    <h3 class="text-center">{{$profile->user->name}}</h3>
                                </div>

                                <div class="col-md-8">
                                    <div class="d-flex align-items-center mt-5">
                                        {{$profile->biography}}
                                    </div>

                                </div>
                            </div>
                            {{--authenticate if the user is the same as the profile--}}
                            @if($profile->User->id == Auth::user()->id)
                                <a href="{{route('profile.edit',$profile->id)}}" class="btn btn-light shadow btn-block mt-2">
                                        Update Profile
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

<div class="container-fluid ">

            <ul class="nav nav-pills justify-content-center mt-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#home"><i class="fa fa-square" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#menu2"><i class="fa fa-th" aria-hidden="true"></i></a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="home" class="container-fluid tab-pane active "><br>
                    <div class="row justify-content-center">
{{--                            post counter--}}
                            @if(count($posts) > 0)
                                @foreach($posts as $post)
                                <div class="card mx-auto custom-card mb-5" id="prova">

                                <div class="row post-header col-12 py-2 px-3">
                                        <div class="col-6 float-left ">
                                             <a href="{{route('profile.show',$post->User->id)}}">
                                                 <img class="rounded-circle" src="{{asset('upload-img/'.$post->User->Profile->img)}}" style="width: 50px;">
                                                <h4 class="text-left d-inline ml-2">{{$post->User->name}}</h4>
                                           </a>
                                        </div>

                                        <div class="col-6 float-right ">
                                            <h4 class="text-right">{{$post->title}}</h4>
                                        </div>
                                </div>

                                    <img class="card-img" src="{{asset('upload-img/'.$post->img)}}" alt="Card image cap" style="width: 600px">
                                        <div class="card-body px-3">

                                            @if (! $post->liked)
                                                <a href="{{ route('posts.like', $post) }}" class="btn btn-light btn-sm">
                                                    <i class="far fa-heart"></i>
                                                </a>

                                                <div class="col-12 float-left text-left">
                                                    <p class="">{{ $post->likesCount }} Likes</p>
                                                </div>
                                            @else
                                                <a href="{{ route('posts.unlike', $post) }}" class="btn btn-danger btn-sm">
                                                    <i class="far fa-heart"></i>
                                                </a>

                                                <div class="col-12 float-left text-left">
                                                    <p class="">{{ $post->likesCount }} Likes</p>
                                                </div>

                                            @endif
                                            <div class="col-12 float-left text-left">
                                                {{--relationship of post and user to get the name--}}
                                                 <strong>{{$post->User->name}}</strong> {{$post->description}}
                                              <a class="" data-toggle="collapse" href="#collaps{{$post->id}}" role="button" aria-expanded="false" aria-controls="collaps{{$post->id}}">
                                                more   {{  $post->Comment->count() }} Comments
                                              </a>

                                            </div>
                                        </div>

                                        <div class="row post-header px-2 pb-2">
                                            <div class="col-12 float-left text-left">
                                                {{ $post->User->Comment }}
                                                <div class="collapse" id="collaps{{$post->id}}">
                                                  <div class="card card-body" style="border:0px">
                                                     @include('posts.comments')
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                @endforeach
                            @else
                                <p class="text-center w-100">No hay recetas disponibles</p>
                            @endif
                    </div>
                </div>

                <div id="menu2" class="container-fluid tab-pane fade"><br>
                    <div class="row ">
                    @if(count($posts2) > 0)
                    @foreach($posts2 as $post)
                        <div class="col-md-4 col-sm-6 px-1 my-1 ">
                            <div class="card mx-auto custom-card mb-5" id="prova">
                                <div class="row post-header col-12 py-2 px-3">
                                        <div class="col-6 float-left ">
                                             <a href="{{route('profile.show',$post->User->id)}}">
                                                 <img class="rounded-circle" src="{{asset('upload-img/'.$profile->img)}}" style="width: 50px;">
                                                <h4 class="text-left d-inline ml-2">{{$post->User->name}}</h4>
                                           </a>
                                        </div>

                                        <div class="col-6 float-right ">
                                            <h4 class="text-right">{{$post->title}}</h4>
                                        </div>
                                </div>

                                        <img class="card-img" src="{{asset('upload-img/'.$post->img)}}" alt="Card image cap">

                                        <div class="card-body px-3">

                                            @if (! $post->liked)
                                                <a href="{{ route('posts.like', $post) }}" class="btn btn-light btn-sm">
                                                    <i class="far fa-heart"></i>
                                                </a>

                                            <div class="col-12 float-left text-left">
                                                <p class="">{{ $post->likesCount }} Likes</p>
                                            </div>
                                                <p class=""></p>
                                            @else
                                                <a href="{{ route('posts.unlike', $post) }}" class="btn btn-danger btn-sm">
                                                    <i class="far fa-heart"></i>
                                                </a>

                                            <div class="col-12 float-left text-left">
                                                <p class="">{{ $post->likesCount }} Likes</p>
                                            </div>

                                            @endif
                                            <div class="col-12 float-left text-left">
                                                 <strong>{{$post->User->name}}</strong> {{$post->description}}
                                              <a class="" data-toggle="collapse" href="#collaps{{$post->id}}" role="button" aria-expanded="false" aria-controls="collaps">
                                                más
                                              </a>

                                            </div>
                                        </div>
                                     <div class="row post-header px-3 pb-3">
                                            <div class="col-10 float-left text-left">
                                                <div class="collapse" id="collaps{{$post->id}}">
                                                  <div class="card card-body" style="border:0px">
                                                     @include('posts.comments')
                                                  </div>
                                                </div>

                                            </div>
                                            <div class="col-1 float-right text-right">
                                             @if($profile->User->id == Auth::user()->id)
                                                <form action="{{ route('posts.destroy',$post->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                      <div class="dropdown-menu">
                                                            <a class="dropdown-item"  data-toggle="modal" data-target="#exampleModalCenter">
                                                              Eliminar
                                                            </a>
                                                        <a class="dropdown-item" href="{{ route('posts.edit',$post->id)}}">Editar</a>
                                                      </div>
                                                        @include('profile.modal')
                                                    </a>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                     @endforeach
                    @else
                        <p class="text-center w-100">No hay recetas disponibles</p>
                    @endif

                    </div>
                </div>
            </div>
</div>

@endsection
