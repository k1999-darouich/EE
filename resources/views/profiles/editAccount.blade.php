@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row profile">
        <div class="col-md-4 col-sm-12 profile-left" style="padding-left: 2rem; ">
            <div class="col-md-12 col-sm-12 position-fixed " style="width: auto;">
                
                <div class="row">
                    <div class="col-md-12 col-6 img1">
                        @if($user->profile->image )
                        <img src="/storage/{{ $user->profile->image }}" class="rounded-circle">
                        @else
                        <img src="/images/default-profile-picture1.jpg" class="rounded-circle">
                        @endif

                    </div>
                    <div class="col-md-12 col-6 pt-3 profile-inf ">
                        <div class="profile-name">{{ $user->profile->pseudo_name }}</div>
                        
                        @if($user->profile->profession)
                        <div>{{$user->profile->profession->name}}</div>
                        <div class="pt-1" style="text-align: center;">
                            <div class="row">
                                <div class="offset-4 col-1 ">
                                    <a href="{{$user->profile->facebook_url}}"><i class="fab fa-facebook-f" style="font-size: large;"></i></a>
                                </div>
                                <div class="col-1">
                                    <a href="{{$user->profile->instagram_url}}"><i class="fab fa-instagram" style="font-size: large;"></i></a>
                                </div>
                                <div class="col-1">
                                    <a href="{{$user->profile->gmail_url}}"><i class="fab fa-google" style="font-size: large;"></i></a>
                                </div>
                            </div>

                        </div>
                        @endif


                    </div>
                </div>
                <hr color="white">
                <div class="col-md-12 col-sm-12 bloc">
                    <i class="far fa-calendar-alt" style="font-size: large;"></i>
                    <a href="/profile/{{ $user->id }}">EVENTS</a>
                </div>
                @can('update', $user->profile)
                <div class="col-md-12 col-sm-12 bloc bloc-active">
                    <div class=" dropdown edit-dropdown">
                        <a id="navbarDropdown" href="/profile/{{ $user->id }}/edit" class="nav-link " href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #fff;">
                            <i class="fas fa-cogs " style="font-size: large;"></i> SETTINGS<span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" >
                            <a class="dropdown-item" href="/profile/{{ $user->id }}/edit">
                                Edit Profile
                            </a>
                            <a class="dropdown-item" href="/profile/{{ $user->id }}/editUser">
                                Change Password
                            </a>


                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 bloc">
                    <i class="fas fa-sign-out-alt" style="font-size: large;"></i>

                    <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('LOGOUT') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                @endcan



            </div>

        </div>
        <div class="col-md-8 col-sm-12 profile-right " style="height: 86vh">
            <div class="box" >
                <div class=" col-12 heading1">Change password
                    <hr color="#007399">
                </div>

                <form method="POST" class="mt-3" action="/profile/{{ $user->id }}/editUser">

                    @csrf
                    @if(session('success'))
                    <div class="alert alert-success ml-5">
                        {{session('success')}}
                    </div>
                    @endif
                    @if(session('warning'))
                    <div class="alert alert-warning ml-5">
                        {{session('warning')}}
                    </div>
                    @endif
                    @if(session('danger'))
                    <div class="alert alert-danger ml-5">
                        {{session('danger')}}
                    </div>
                    @endif

                    <div class="offset-2 col-8">
                    <div class="input-box">
                            <input id="old-password" type="password" class=" @error('password') is-invalid @enderror" name="old-password" autocomplete="new-password" required>

                            @error('old-password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="">Old password</label>
                        </div>
                        <div class="input-box">
                            <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" autocomplete="new-password" required>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="">New Password</label>
                        </div>
                        <div class="input-box">
                            <input id="password-confirm" type="password" class="" name="password_confirmation" autocomplete="new-password" required>
                            <label for="">Confirm Password</label>
                        </div>
                        <input type="submit" value="Save" />
                    </div>

                </form>
                <div class="mt-5" style="text-align: end;">
                    <form action="/profile/{{ $user->id }}" method="POST" style="text-align: end;">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-info" onclick="return confirm('Are you sure?')"> <i class="fa fa-trash"></i> </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection