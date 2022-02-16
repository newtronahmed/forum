<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use App\Http\Requests\DiscussionStoreRequest;
use App\Notifications\BestReply;
use App\Reply;
// use App\Http\Requests\DiscussionStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class DiscussionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create','store','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Discussions.index')->with('discussions',Discussion::filterByChannel()->withLikes()->latest()->paginate(3));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscussionStoreRequest $request)
    {
        auth()->user()->discussions()->create([
            'title'=> $request->title,
            'content'=>$request->content,
            'channel_id'=>$request->channel,
            'slug'=> Str::slug($request->title),
        ]);
        
        return redirect()->route('discussions.index');

       
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $discussion)
    {
        $discussion = Discussion::where('slug',$discussion)->withLikes()->first();
        return view('discussions.show',compact('discussion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function markAsBestReply(Discussion $discussion, Reply $reply){
        // dd($reply);
        
            $discussion->markAsBestReply($reply);
        
        
        return redirect()->back();
    }
    
    
}
