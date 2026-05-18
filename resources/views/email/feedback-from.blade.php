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

    <p>Thank you for taking the time to submit your feedback for <strong>{{ $fromName }}</strong>.</p>

    <p><strong>Rating:</strong> {{ $rating }}/5</p>

    @if(!empty($feedback))
        <p><strong>Feedback:</strong> {{ $feedback }}</p>
    @endif

    <p>We sincerely appreciate your input. Your feedback plays a vital role in helping us enhance our service quality and ensure a better experience in future interactions.</p>
    <p>Thank you once again for your time and valuable insights.</p>
</div>
@stop
