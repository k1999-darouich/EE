<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    //
    // create
    public function create()
    {
        return view('contact.create');
    }
    public function store()
    {
        $data=request()->validate(
            [
                'name'=>'required|min:3',
                'email'=>'required|email',
                'message'=>'required',
                ]
            );
        Mail::to('khawla.de.ka@gmail.com')->send(new ContactFormMail($data));
        Session()->flash('message',' We have received your message, we\'ll be in touch !');
        return redirect('/contact');
    }

}
