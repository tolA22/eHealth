@component('mail::message')

<br>
Hello {{ucwords($username)}}, welcome to your new eHealth Account<br>


Sign in to your eHealth Account to access the services. <br>

Your username: {{$email}} <br>

Password: Click Sign in below to set your password and sign in. <br>
@component('mail::button', ['url' => '/login'])
Button Text
@endcomponent
<br>

Regards, <br> <br>

The eHealth team

@endcomponent