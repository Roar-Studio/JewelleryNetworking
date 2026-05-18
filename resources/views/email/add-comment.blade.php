@extends('email.home')
@section('header')
    @section('css')
        <style>
        </style>
    @stop
@stop
@section('content')
    <div class="col-md-12">
        <h2>Dear {{ $member->first_name . ' ' . $member->last_name }},</h2>
        <h2>New Comment Submitted</h2>

            <p><strong>From:</strong> {{ $user->first_name . ' ' . $user->last_name }} ({{ $user->email }})</p>

            <p><strong>Title:</strong> {{ $data['title'] }}</p>

            @if(!empty($data['comment']))
                <p><strong>Comment:</strong> {{ $data['comment'] }}</p>
            @endif

            @if($filePath)
                <p><strong>Attachment:</strong> File attached with this email.</p>
            @endif

    </div>
@stop
