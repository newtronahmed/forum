<x-master>
<main class="container pt-4">
            
    <div class="row">
        
        <div class="col-md-3">
            <div class="w-100 ">
                <a href="{{route('discussions.create')}}" class="btn btn-success w-100 mb-1">Add discussions</a>
            </div>
            <h4 class="text-center  card-header">Channels</h4>
            <ul class="list-group">
                @foreach ($channels as $item)
                <li class="list-group-item">
                    <a href="{{'/discussions?channel='.$item->slug}}">{{$item->name}}</a>
                    
                </li>
                @endforeach 
              </ul>
        </div>
        <div class="col-md-9">
            {{-- @yield('content') --}}
            
            {{$slot}}
        </div>
    </div>
   
</main>
</x-master>