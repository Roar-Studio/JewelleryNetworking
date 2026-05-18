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
        <p>Welcome!<br/>
        Your account has been successfully created on Jewellery Networking.<br/>
        Here’s what you can do next:<br/>
        Explore features tailored just for you<br/><br/>
        Set up your profile and preferences<br/>
        If you have any questions, feel free to reach out to us at support@jewellerynewworking.com.<br/>
        <br/>
        We’re excited to have you with us!</p>
        <p>
            <a href="{{ url('/login') }}" style="display:inline-block;padding:10px 20px;background:#264C5A;color:#fff;text-decoration:none;">
                Login to Your Account
            </a>
        </p>

    </div>
@stop

