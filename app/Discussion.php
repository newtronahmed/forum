<?php

namespace App;

use App\Notifications\BestReply;
use App\Notifications\NewLike;
use App\Notifications\NewReply;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['title','slug','channel_id','content','user_id','reply_id'];
    
    public function author(){
        return $this->belongsTo('\App\User','user_id');
    }
    public function replies(){

        return $this->hasMany('\App\Reply');
    }
   public function getRouteKeyName(){
       return 'slug';
   }
   public function bestReply(){
       return $this->belongsTo('\App\Reply','reply_id');
   }
   public function markAsBestReply($reply){
    $this->update([
        'reply_id' => $reply->id,
    ]);

    if($this->author->id === $reply->owner->id){
        return ;
    }

    $reply->owner->notify(new BestReply($reply->discussion));
    
       
   }

   public function scopeFilterByChannel($builder){
       $channel =Channel::where('slug', request()->query('channel'))->first();
    if($channel){
       return $builder->where('channel_id',$channel->id);  
    }
    return $builder;

   }
  
   public function likes(){
       return $this->hasMany('\App\like');
   }

   public function like($user,$like){
    //    dd( $this);
    $this->likes()->updateOrCreate(['user_id'=>$user->id,],['like'=>$like]);
    if($this->author->id === $user->id){ return ;}

    $this->author->notify(new NewLike($this));
   }
   public function scopeWithLikes($builder){
        $builder->leftJoinSub('Select discussion_id , sum(likes.like) totalLikes, sum(!likes.like) dislikes from likes group by likes.discussion_id', 'likess' , 'likess.discussion_id' , 'id');
   }
   
   public function isLikedBy($user){
     return (bool)  $this->likes->where('user_id',$user->id)->where('like',true)->count();
   }

   public function isDislikedBy($user){
     return (bool)  $this->likes->where('user_id',$user->id)->where('like',false)->count();
   }

   

}
