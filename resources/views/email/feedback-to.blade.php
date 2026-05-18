@extends('email.home')

@section('header')
    @section('css')
        <style>
            p { font-size: 15px; line-height: 1.6; }
            h2 { color: #333; }
        </style>
    @stop
@stop

@section('content')
<div class="col-md-12">
    <h2>Dear {{ $toName }},</h2>

    <p>We would like to inform you that you have received new feedback from <strong>{{ $fromName }}</strong>.</p>

    <p><strong>Rating:</strong> {{ $rating }}/5</p>

    @if(!empty($feedback))
        <p><strong>Feedback:</strong> {{ $feedback }}</p>
    @endif

    <p>Kindly review the feedback at your earliest convenience.</p>
    <p>Thank you for your attention to this matter.</p>
</div>
@stop
