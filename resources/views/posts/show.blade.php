
@extends('layouts.app')

@section('content')
<div class="container event" style="margin-top: 3rem;" >
    <div class="row event-inf  " >
        <div class="col-md-3">
            <img src="/storage/{{ $post->image }}" alt="" style="border-radius: 2%;" width="100%" >
        </div>
          
        
        <div class=" col-md-9 ">
            <h1 >{{$post->intitule}}</h1>
            <h6>{{$post->caption}}</h6>
            <h6>Du : {{ $post->du }}</h6>
            <h6>Au : {{ $post->au }}</h6>
            <a href="/profile/{{ $post->user->id }}">
                        <input type="submit" value="New Event" class="mb-3 mt-1"/>
            </a>
        </div>
    </div>
    <hr color="#007399" style="font-weight: lighter;">

<div class="event-detail">
    <div class="row">
        <div class="col-md-8 ">
            <div class="event-detail-left">
                <div class="event-detail-header">
                    Présentation
                </div>
                <div class="event-detail-content pt-2">
                    <p>   Description: {{ $post->description }}</p> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="h5">Domaine d'activité de l'évènement</div>
                            <i class="fas fa-bookmark mr-1" style="color:#007399 ;" ></i>&#160;{{ $post->categorie->name }}
                        </div>
                        <div class="col-md-6">
                        <div class="h5">Type de l'évènement</div>
                        {{ $post->type->name }}
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <div class="event-detail-right mt-3">
                <div class="event-detail-header">
                    Horaire
                </div>
                <div class="row pt-3">
                    <div class="col-md-6">
                    <div class="h5">Ouverture</div>
                        {{ $post->du }}
                    </div>
                    <div class="col-md-6">
                    <div class="h5">Cloture</div>
                        {{ $post->au }}
                    </div>
                </div>
                
            </div>
            <div class="event-detail-right mt-3">
                <div class="event-detail-header">
                    Comments
                </div>
                <div class="row pt-3" >
                <p><small class="text-muted font-weight-normal ml-2">{{ $post->comments->count()}} Comments</small></p>
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
                        
                        <div class="mt-2 col-12  " >
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
        <div class="col-md-4 ">
            <div class="event-detail-right">
            <div class="event-detail-header">
                   Organisateur
                </div>
                <div class="d-flex align-items-center pt-3" >
                    <div style="margin-top: -10%; ">
                        <img class="w-100 rounded-circle pr-3 " src="/storage/{{ $post->user->profile->image }}" style="max-width:90px;">
                    </div>
                    <div class="">
                        <div class="font-weight-bold">
                            <a href="/profile/{{ $post->user->id }}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>

                        </div>
                        @if($post->user->profile->profession)
                        <div>{{$post->user->profile->profession->name}}</div>
                        <div class="pt-1" style="text-align: center;">
                            <div class="row">
                                <div class="col-1 ">
                                <a href="{{$post->user->profile->facebook_url}}" ><i class="fab fa-facebook-f" style="font-size: large; color: #007399;"></i></a>
                                </div>
                                <div class="col-1">
                                <a href="{{$post->user->profile->instagram_url}}"><i class="fab fa-instagram" style="font-size: large; color: #007399;"></i></a>
                                </div>
                                <div class="col-1">
                                <a href="{{$post->user->profile->gmail_url}}"><i class="fab fa-google" style="font-size: large; color: #007399;"></i></a>
                                </div>
                            </div> 
                            
                        </div>
                        @endif
                        <a href="/profile/{{ $post->user->id }}">
                        <input type="submit" value="Détail" class="mb-3 mt-1"/>
                        </a>
                    </div>
                   
                </div>
               
            </div>
            @if($Semilarposts->count()>1)
            <div class="event-detail-right mt-3">
            <div class="event-detail-header">
                   Evénements semilaires
                </div>
                    @foreach($Semilarposts as $Semilarpost)
                    @if($Semilarpost->id!=$post->id)
                    <div class="d-flex row align-items-center pt-3">
                        <div class="col-3">
                            <img class="w-100 pr-3 rounded-circle" src="/storage/{{$Semilarpost->image }}" style="width: 50%;" >
                        </div>
                        <div class="col-9" style="margin-left: -8%;"> 
                            <a href="/p/{{ $Semilarpost->id }}" title="{{ $Semilarpost->intitule}}">
                                    <div class="main-text" >{{ $Semilarpost->intitule}}</div>
                                </a> 
                                <div class="text-muted"><small>{{ $Semilarpost->du }}</small></div>  

                        </div>
                    </div>
                    
                    @endif
                    @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
</div>
@endsection