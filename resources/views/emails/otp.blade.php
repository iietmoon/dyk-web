@extends('layouts.emails')

@section('title', 'Your login code')

@section('content')

<h1
          style="margin:0rem;font-weight:500;font-size:1.875rem;line-height:1.2;color:rgb(0, 0, 0)">
          Your login code
        </h1>
        <p
          style="font-size:1.125rem;line-height:2rem;margin-bottom:1rem;margin-top:16px">
          Use this code to sign in:
        </p>
        <p
          style="font-size:2.5rem;line-height:1;margin-bottom:1.5rem;margin-top:1rem;font-weight:700;letter-spacing:0.5em;color:rgb(16,24,40)">
          {{ $otp }}
        </p>
        <p
          style="font-size:0.875rem;line-height:1.25rem;color:rgb(16,24,40);margin-top:16px;margin-bottom:16px">
          This code expires in {{ config('api.otp_expiry_minutes', 10) }} minutes. <br>If you didn't request this, you can ignore this email.
        </p>
@endsection
