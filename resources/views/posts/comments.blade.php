{{--@foreach($comments as $comment)--}}
{{--    {{$comment->count()}}--}}
{{--    @if($comment->post_id == $post->id)--}}
{{--        <div class="col-12 float-left text-left">--}}
{{--            <p class="form-group"> <strong>{{$comment->User->name}}</strong> {{$comment->body}}</p>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--@endforeach--}}

    @forelse ($post->Comment as $comment)
        <div class="col-12 float-left text-left">
            <p class="form-group">
                <img class="card-img" src="{{asset('upload-img/'.$comment->User->Profile->img)}}"  style="width: 25px;border-radius: 50%">
                <strong>{{$comment->User->name}}</strong> {{$comment->body}}
            </p>
        </div>
    @empty
        <p>This post has no comments</p>
    @endforelse

<form method="POST" action="{{ route('comments.store')  }}">
    @csrf

    <div class="form-group">
        <textarea class="form-control" name="body"></textarea>
        <input type="hidden" name="post_id" value="{{ $post->id }}" />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Share" />
    </div>
</form>
