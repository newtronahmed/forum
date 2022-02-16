<x-app>
@section('css')
    <link rel="stylesheet" href="{{asset('css/trix.css')}}">
@endsection

    <div class="card">
        <div class="card-header text-center">
            Add Discussions
        </div>
        <div class="card-body">
            <form action='{{route('discussions.store')}}' method='POST'>
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                 @error('title')
                    <span class="text-danger">{{$message}}</span> 
                 @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Content</label>
                    <input type="hidden" name='content' id="content">
                    <trix-editor input='content'></trix-editor>
                 @error('content')
                    <span class="text-danger">{{$message}}</span> 
                 @enderror
                </div>
                <div class="form-group">
                    <label for="channels">Channel</label>
                <select name="channel" class="form-control">
                    @foreach ($channels as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                    
                </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>

@section('js')
    <script src='{{asset('js/plugins/trix.js')}}'></script>
    @endsection
</x-app>