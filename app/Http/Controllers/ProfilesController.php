<?php

namespace App\Http\Controllers;

use App\Post;
use App\Profession;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(\App\User $user)
    {
//        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        return view('profiles.index', compact('user'/*, 'follows'*/));
    }


    public function edit(\App\User $user)
    {
        $this->authorize('update', $user->profile);
        $professions=Profession::all();
        return view('profiles.editProfile', [
            'user' => $user,
        ],compact('professions'));
    }

    public function update(\App\User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'pseudo_name' => 'required',
            'profession_id' => 'required',
            'facebook_url' => 'url',
            'instagram_url' => 'url',
            'gmail_url' => 'url',
            'image' => '',
            
        ]);


        if(request('image')){
            $imagePath=request('image')->store('profile', 'public');

            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        $user=User::find(Auth::user()->id);
        if($user)
        {
            $data=null;
            if(Auth::user()->email===request('email'))
            {
                $data=request()->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                    
                ]);
            }
            else
            {
                $data=request()->validate([
                    'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                
            ]);
            }
            if($data)
            {
                $user->fill([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    

                ]);
                $user->save();
                request()->session()->flash('success','Your details have now been updated');
            }
        return redirect("/profile/{$user->id}");
    }
}
    public function destroy(\App\User $user){
        $UsersPosts= Post::where('user_id','=',$user->id)->get();
        $UsersProfile= Profile::where('user_id','=',$user->id)->get();
        foreach($UsersPosts as $usersPost)
        {   
            $usersPost->delete();
        }
        foreach($UsersProfile as $UserProfile)
        {
            $UserProfile->delete();
        }
        
        $user->delete();
        return redirect('/');
    }
}
