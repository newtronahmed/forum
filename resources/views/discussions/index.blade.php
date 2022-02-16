<x-app>
<div>
    @if(request()->has('channel'))
    <h4 class="text-center">Channel: {{request()->channel}}</h4>
    @endif
</div>
@if($discussions->count()< 1)
<div class="font-bold text-center">
    Am lonely here
</div>
@else
    @foreach($discussions as $discussion)
    <div class="w-100 mb-4 ">
        <div class="card">
            <x-discussionHeader :discussion='$discussion'></x-discussionHeader>
            <div class="card-body">
               
            <a href="{{route('discussions.show',$discussion)}}"> {{$discussion->title}}</a>
            </div>
            
    
        </div>
        
    </div>
    @endforeach
@endif
</x-app>