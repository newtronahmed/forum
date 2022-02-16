<div class="card-header">
    <div class="row justify-content-between align-content-center">
        <div> {{$discussion->author->name}}</div>
        <div> <a  href="{{route('discussions.show',$discussion)}}" class="btn btn-success btn-sm ">view</a></div>
    </div>
  
</div>