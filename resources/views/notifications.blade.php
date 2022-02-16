<x-app>
{{-- {{dd($notifications->first()->data['discussion']['slug'])}} --}}
<h1>This is the notifications Page</h1>
<div class="card">
    <div class="card-header">Notifications</div>
    <div class="card-body">
    <ul class="list-group">
        
    
    @foreach($notifications as $notification)

        @if($notification->type === 'App\Notifications\NewReply')    
            
        <li class="list-group-item">
          You have a new reply to your discussion <strong> {{$notification->data['discussion']['title']}} </strong>
          <a  href="{{route('discussions.show',$notification->data['discussion']['slug'])}}" style='text-decoration:none;'> click to view  </a>
        </li>
        
        @endif
        @if($notification->type === 'App\Notifications\BestReply')    
            
        <li class="list-group-item">
          Your reply to the discussion <strong> {{$notification->data['discussion']['title']}} </strong> has been marked as the best reply by the author
          <a  href="{{route('discussions.show',$notification->data['discussion']['slug'])}}" style='text-decoration:none;'> click to view  </a>
        </li>
        
        @endif
        @if($notification->type === 'App\Notifications\NewLike')    
            
        <li class="list-group-item">
          Your  discussion <strong> {{$notification->data['discussion']['title']}} </strong> has gained a like
          <a  href="{{route('discussions.show',$notification->data['discussion']['slug'])}}" style='text-decoration:none;'> click to view  </a>
        </li>
        
        @endif
        
    @endforeach
    </ul>
    {{$notifications->links()}}
    </div>
</div>
</x-app>