
@section('css')
    <link rel="stylesheet" href="{{asset('css/trix.css')}}">
@endsection
<x-app>
  
<div class="mb-4">
    <div class="card">
        {{-- <x-discussionHeader :discussion='$discussion'></x-discussionHeader> --}}
        <div class="card-header">
            <div class="row justify-content-between align-content-center">
                <div> {{$discussion->author->name}}</div>
                <div class="">
                
                    <form class="d-none" id="{{'discussionLike'.$discussion->id}}" action="{{route('discussion.like',$discussion)}}" method="post">@csrf</form>
                    <form class="d-none" id="{{'discussionDislike'.$discussion->id}}" action="{{route('discussion.dislike',$discussion)}}" method="Post">@csrf @method('DELETE')</form>
                    <span class="btn btn-sm {{$discussion->isLikedBy(auth()->user()) ? 'btn-success': 'btn-default'}}" onclick="event.preventDefault() 
                    document.getElementById('{{'discussionLike'.$discussion->id}}').submit()">👍{{$discussion->totalLikes}}</span>
                    <span class="btn btn-sm {{$discussion->isDislikedBy(auth()->user()) ? 'btn-success': 'btn-default'}}"  onclick="event.preventDefault() 
                    document.getElementById('{{'discussionDislike'.$discussion->id}}').submit()">👎{{$discussion->dislikes}}</span>
                </div>
            </div>
          
        </div>
        <div class="card-body">
            <div class="card-title font-weight-bold">{{$discussion->title}}</div>
            <div class="card-content">
                {!! $discussion->content !!}
            </div>
            
        </div>
        @if($discussion->bestReply)
        <div class="card bg-success my-4" style="color: white;">
            <div class="card-header d-flex justify-content-between">
                <div>Best reply</div>
                <div>{{$discussion->bestReply->owner->name}}</div>
            </div>
            <div class="card-body">
                {!! $discussion->bestReply->content !!}
            </div>
        </div>
        @endif
    </div>
</div>
<div>
    @foreach($discussion->replies()->paginate(3) as $reply)
        <div class="mb-4">
            <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div>{{$reply->owner->name}}</div>
                    @if(auth()->user()->id===$discussion->author->id)
                    <form method="POST" action="{{route('markAsBestReply',['reply'=>$reply->id,'discussion'=>$discussion])}}"> @csrf <button class="btn btn-success">mark as best reply</button></form>
                    @endif
                </div>
            </div>
            <div class="card-body">
                {!! $reply->content !!}
            </div>
            </div>
        </div>
        
    @endforeach
    {{$discussion->replies()->paginate(3)->links()}}
</div>
<div class="mt-4">
    <div class="card">
        <div class="card-header">Reply</div>
        <div class="card-body">
            @auth
            <form action="{{route('replies.store',$discussion->slug)}}" method="POST">
                @csrf
                <input type="hidden" name="content" id="content">
                <trix-editor input='content'></trix-editor>
                <button type="submit" class="btn mt-2 btn-success">submit</button>
            </form>
            @else
            <a href="/login" class="btn-btn-danger">sign in to reply</a>
            @endauth
        </div>
        
    </div>

</div>

@section('js')
    <script src='{{asset('js/plugins/trix.js')}}'></script>
    @endsection
</x-app>