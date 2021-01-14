<?php

namespace App\Http\Controllers;
use Illuminate\Http\Requests;
use App\Comment;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request, $id)
    {
        $data = request()->validate([
            'comment'=>'required|min:5|max:2000',
        ]);
        $post= Post::find($id);
            
        
       $comment= new Comment();
       $comment->comment=$request->comment;
       $comment->post()->associate($post);
       $comment->user()->associate(Auth::user());
       $comment->save();
       $request->session()->flash('success','Success');
        return redirect()->back();
       
    
    }
}
