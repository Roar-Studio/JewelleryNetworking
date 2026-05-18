@extends('email.home')
@section('header')
    @section('css')
        <style>
        </style>
    @stop
@stop
@section('content')
    <div class="col-md-12">
        <h1 style="font-size: 22px; color: #163576;">Your One-Time Password (OTP)</h1>
        <p style="font-size: 13px;">Your OTP is: <strong>{{ $otp }}</strong></p>
        <p style="font-size: 13px;">Please use this OTP to complete your authentication.</p>
    </div>
@stop

