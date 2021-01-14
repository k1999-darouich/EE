@component('mail::message')
# Introduction

<strong>Name : </strong>{{$data['name']}} <br>
<strong>From : </strong>{{$data['email']}} <br>
<strong>Message : </strong>{{$data['message']}}<br>
Thanks,

@endcomponent
