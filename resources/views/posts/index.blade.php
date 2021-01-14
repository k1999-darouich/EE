@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row posts">
        <div class="col-md-2 posts-left">
        <div>
        <i class="fas fa-users"></i> users <br> <hr color="white">
        
        @if(Auth::check())
            @foreach(App\user::all() as $utilisateur)
            @if($utilisateur->isOnline())
           <div class="d-flex mt-1">
            <div class="align-items-top">
                    <img class="rounded-circle"  src="/storage/{{$utilisateur->profile->image }}" style="max-width:30px; border: 3px solid #007399; ">
                </div>
                <div>
                    <i class="fas fa-circle" style="font-size: xx-small; color:#007399"></i> {{$utilisateur->profile->pseudo_name}}  <br>
                </div>
           </div>
            @endif
            @endforeach
            @foreach(App\user::all() as $utilisateur)
            @if(!$utilisateur->isOnline())
            <div class="d-flex mt-1">
            <div class="align-items-top">
                    <img class="rounded-circle"  src="/storage/{{ $utilisateur->profile->image }}" style="max-width:30px; border: 3px solid grey; ">
                </div>
                <div>
                    <i class="fas fa-circle text-muted" style="font-size: xx-small; "></i> {{$utilisateur->profile->pseudo_name}}  <br>
                </div>
           </div>
            @endif
            @endforeach
            @endif
        </div>
        </div>
        <div class="col-md-10 posts-right p-5 ">
            @foreach ($posts as $post)
            <div class="row">
                <div class="col-12">

                    <div class="d-flex align-items-center ">
                        <div>
                            <img class="rounded-circle" src="/storage/{{ $post->user->profile->image }}" style="max-width:60px;">
                        </div>
                        <div class="pl-2 pt-1">
                            <a href="/profile/{{ $post->user->id }}">
                                <span class="text-dark"><b>{{ $post->user->username }}</b> </span>
                            </a>
                            <p><small class="text-muted">publié le : {{ $post->created_at->format('d/M/Y - G:i') }}</small></p>
                        </div>
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col-md-4 post-img">
                        <img src="/storage/{{  $post->image }}" width="100%">
                    </div>
                    <div class="col-md-8 pt-2">
                     <a href="/p/{{ $post->id }}" class="h4">{{$post->intitule}}</a>
                        <h6>{{$post->caption}}</h6>
                        <p>Date : {{ date('d/M/Y - G:i',strtotime($post->du)) }} <b>/</b>
                        {{ date('d/M/Y - G:i',strtotime($post->au)) }}</p>
                        <p><i class="fas fa-bookmark mr-1" style="color:#007399 ;" ></i>&#160;{{ $post->categorie->name }} - {{ $post->type->name }}</p>
                        <p > <a href="/p/{{ $post->id }}" style="color:#007399 ;"><i class="far fa-calendar-check" style="color: #007399;"></i>&#160;Discover</a>
                        </p>
                        <hr>
                        <p><small class="text-muted font-weight-normal">{{ $post->comments->count()}} <i class="fas fa-comment-alt"></i></small></p>
                        <div class=" comment-bloc">
                        <div class="scroll-bar-wrap">
                            <div class="scroll-box">
                                @foreach ($post->comments as $comment)
                                <div class="d-flex  mb-1">
                                    <div class="align-items-top">
                                        <img class="rounded-circle"  src="/storage/{{ $comment->user->profile->image }}" style="max-width:30px; ">
                                    </div>
                                    <div class="ml-2 p-2 comment">
                                        <a href="/profile/{{ $comment->user->id }}">
                                            <span class="text-dark"><small><b>{{ $comment->user->username }} </b></small></span>
                                        </a>
                                        <span class="font-weight-lighter text-muted"><small>{{ $comment->created_at->format('d/M/Y - G:i') }}</small></span>
                                        <p class="comment-text"><small > {{ $comment->comment }}</small></p>
                                    </div>
                                </div>
                                
                                @endforeach
                            </div>
                            <div class="cover-bar"></div>
                        </div>
                            
                        </div>
                        <div class="mt-2 ">
                            <form action='{{ route("comment.store", ["id" => $post->id]) }}' class="box row emoji-picker-container" method="POST">
                                @csrf
                                {{ method_field('POST') }}
                                
                                <div class=" col-1 pt-3" >
                                        <img class="rounded-circle"  src="/storage/{{ $post->user->profile->image }}" style="max-width:30px; ">
                                    </div>
                                    <div class=" col-9 input-box">
                                    <input id="comment" type="comment" class=" @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment')}}" data-emoji-input="unicode" data-emojiable="true" autocomplete="comment" required>

                                    @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="comment" class="ml-2">comment</label>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-info mt-2"> <i class="fas fa-plus"></i> </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @endforeach
        </div>


    </div>
</div>





@endsection