@extends('layouts.emails')

@section('title', 'Welcome to ' . config('app.name'))

@section('content')
<h1
    style="margin:0rem;font-weight:500;font-size:1.875rem;line-height:1.2;color:rgb(0, 0, 0)">
    You Purched a subscription
</h1>
<p
    style="font-size:1.125rem;line-height:2rem;margin-bottom:1rem;margin-top:16px">
    Hi{{ $user->name ? ' ' . $user->name : '' }},
</p>
<p
    style="font-size:1.125rem;line-height:2rem;margin-bottom:1rem;margin-top:16px">
    Thank you for purchasing the subscription.<br>You're all set — welcome to the application.
</p>
<p
    style="font-size:0.875rem;line-height:1.25rem;color:rgb(16,24,40);margin-top:16px;margin-bottom:16px">
    If you have any questions, just reply to this email. We're here to help.
</p>
@endsection
