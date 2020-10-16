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

                            @if($profile->User->id == Auth::user()->id)
                                <a href="{{route('profile.edit',$profile->id)}}" class="btn btn-light shadow btn-block mt-2">
                                        Update Profile
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

<div class="container-fluid ">
          <!-- Nav pills -->
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
                            @if(count($post) > 0)
                                @foreach($post as $post)
                                <div class="card mx-auto custom-card mb-5" id="prova">
                                    <div class="row post-header col-12 py-2 px-3">
                                        <div class="col-6 float-left "><h4>{{$post->title}}</h4></div>
                                    </div>
{{--                                    <a href="{{route('posts.show',['post'=>$post->id])}}">--}}
                                        <img class="card-img" src="{{asset('upload-img/'.$post->img)}}" alt="Card image cap" style="width: 600px">
{{--                                    </a>--}}
                                    <div class="card-body px-3">
                                            @if (! $post->liked)
                                                <a href="{{ route('posts.like', $post) }}" class="btn btn-light btn-sm">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                                <p class="">{{ $post->likesCount }} Likes</p>
                                            @else
                                                <a href="{{ route('posts.unlike', $post) }}" class="btn btn-danger btn-sm">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                                <p class="">{{ $post->likesCount }} Likes</p>
                                            @endif
                                    </div>
                                     <div class="row post-header px-3 pb-3">
                                         <div class="col-10 float-left text-left">Likes</div>
                                        <div class="col-10 float-left text-left">{{$post->description}}</div>
                                        <div class="col-1 float-right text-right">
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
                    @if(count($post2) > 0)
                    @foreach($post2 as $post2)
                        <div class="col-md-4 col-sm-6 px-1 my-1 ">
                            <div class="card mx-auto custom-card" id="prova">
                                <div class="row post-header col-12 py-2 px-3">
                                    <div class="col-6 float-left "><h4>{{$post2->title}}</h4></div>
                                </div>
                                <img class="card-img" src="{{asset('upload-img/'.$post2->img)}}" alt="Card image cap">
                                <div class="card-body px-3">
                                    <h5 class="card-title"><i class="far fa-heart"></i></h5>
                                </div>
                                 <div class="row post-header px-3 pb-3">
                                     <div class="col-10 float-left text-left">Likes</div>
                                    <div class="col-10 float-left text-left">{{$post2->description}}</div>
                                        <div class="col-1 float-right text-right">
                                            <form action="{{ route('posts.destroy',$post->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                  <div class="dropdown-menu">
                                                        <a class="dropdown-item"  data-toggle="modal" data-target="#exampleModalCenter">
                                                          Eliminar
                                                        </a>
                                                    <a class="dropdown-item" href="">Editar</a>
                                                  </div>
                                                    @include('profile.modal')

                                                </a>
                                            </form>
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
