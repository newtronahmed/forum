<?php

namespace App\Http\Controllers;

use App\Discussion;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function store (Discussion $discussion){
        $discussion->like(auth()->user(),true);
        return redirect()->back();
    }
    public function delete(Discussion $discussion){
        $discussion->like(auth()->user(), false);
        return redirect()->back();
    }
}
