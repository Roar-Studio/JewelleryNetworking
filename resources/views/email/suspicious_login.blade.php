@extends('email.home')
@section('header')
    @section('css')
        <style>
        </style>
    @stop
@stop
@section('content')
    <div class="col-md-12">
        <h2>HI {{ $name }},</h2>
        <p>We noticed an unsuccessful login attempt to your account using incorrect credentials.</br></br>

            🕒 Time: {{ $login_datetime }}  </br>
            📍 IP Address: {{ $ip_address }}</br>
            📍 Device id: {{ $device_id }}</br>
            Browser info: {{ $browser_info }}</br>
            🔁 Attempted With: {{ $attempted_email_id }}</br></br>

            If this was you, no further action is needed.</br></br>

            If you didn’t try to sign in, we recommend changing your password immediately to keep your account secure.</br></br>

            You can change your password <a href="{{ url('/login') }}">here</a></p>

    </div>
@stop

