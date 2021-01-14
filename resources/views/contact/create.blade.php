@extends('layouts.app')
@section('title','Contact Us')
@section('content')
    
      

<div class="container col-9 bg-white " style="margin-top: 4rem; box-shadow: -5px -5px 5px rgba(0, 0, 0, 0.5);">



<form class="" action="/contact" method="POST">
        @csrf
        <div class="row ">
            <div class="col-8 box2 offset-2">
                <div class="row ">
                    
                    <div class=" col-12 heading1">Contact Us<hr color="#007399" ></div>
                </div>
                @if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        <strong>Thank you</strong><br>
        {{ session()->get('message')}}
    </div>
@endif
                <div class="input-box">
                    <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus required>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label >Name</label>
                </div>
                <div class="input-box">
                    <input id="email" type="text" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus required>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label >Email</label>
                </div>
                <div class="input-box">
                    <textarea id="message" placeholder="message" width="100%" type="textarea" rows="4" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" autocomplete="message" autofocus required>
                    </textarea>
                    @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    
                </div>
         

                <input type="submit" value="Send message" class="mb-3"/>

            </div>

        </div>


    </form>
</div>

@endsection