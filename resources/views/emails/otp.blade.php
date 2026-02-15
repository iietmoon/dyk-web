@extends('layouts.emails')

@section('title', 'Your login code')

@section('content')
<div style="text-align: center;">
  <h1 style="margin:0;font-weight:500;font-size:1.875rem;line-height:1.2;color:rgb(0,0,0);">
    Here is your One-Time Password
  </h1>
  <p style="font-size:1.125rem;line-height:2rem;margin-bottom:1rem;margin-top:16px;">
    Hey Dear, probably you requested to sign in to your account. here is your code for verification.
  </p>
  <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:1.5rem auto;">
    <tr>
      <td style="background-color:#000;border-radius:8px;padding:1rem 1.5rem;">
        <span style="font-size:2rem;font-weight:700;letter-spacing:0.25em;color:#fff;">
          {{ $otp }}
        </span>
      </td>
    </tr>
  </table>
  <p style="font-size:0.875rem;line-height:1.25rem;color:rgb(16,24,40);margin-top:16px;margin-bottom:16px;">
    This code expires in {{ config('api.otp_expiry_minutes', 10) }} minutes.<br>If you didn't request this, please ignore this email.
  </p>
</div>
@endsection
