@extends('email.home')
@section('header')
    @section('css')
        <style>
        </style>
    @stop
@stop
@section('content')
    <div class="col-md-12">
        <h2>New Community Member</h2>
        <p>A new user has requested to joined the community with the following email address:</p>
        <p><strong>{{ $email }}</strong></p>
    </div>
@stop

