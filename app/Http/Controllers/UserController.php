<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user= User::find(Auth::user()->id);
        if($user){
            return view('profiles.editAccount')->withUser($user);
        }
        else{
            return redirect()->back();
        }
      
    }

    /**
     * @param Request $request
     * @return
     */
    public function update(Request $request)
    {
        $user=User::find(Auth::user()->id);
        if($user)
        {
            $data=null;
            $current_password = Auth::User()->password;           
            if(Hash::check($request['old-password'], $current_password))
            {
                $data=$request->validate([
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
                if($request['old-password']===$request['password'])
                {
                    $request->session()->flash('warning','meme password');
                    return redirect()->back();
                }
                else
                {
                    if($data)
                    {
                        $user->fill([
                            'password'=> Hash::make($request['password']),
        
                        ]);
                        $user->save();
                        $request->session()->flash('success','Your details have now been updated');
                        return redirect()->back();
                    }
                   

                }
            }
            else
            {
                $request->session()->flash('danger','old password incorrect');
                return redirect()->back();

            }
            
           
        }
        else
        {
             // Redirect to route
            return redirect("/profile/{$user->id}/editUser");
        }
        }
}