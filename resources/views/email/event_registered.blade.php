@extends('email.home')
@section('header')
    @section('css')
        <style>
        </style>
    @stop
@stop
@section('content')
    <div class="col-md-12">
        <h2 style="text-transform: capitalize;">Dear {{ $name }},</h2>
        <p style="text-transform: capitalize;">Thank you for registering for <b>{{ $event_name }}!</b><br/><br/>

            📅 Event Date and time: {{ $event_start_datetime }} <br/> 
            {!! $google_meet_link ? '💻 Google Meet link: <a href="' . $google_meet_link . '">' . $google_meet_link . '</a><br/><br/>' : '' !!}
            📍 Venue: {{ $venue_address }}<br/><br/>

            Your order ID is : {{ $order_id }}.<br/>
            @if(!empty($membershipId))
                Membership ID is : {{ $membershipId }}.<br/>
            @endif
            Please download the invoice <a href="{{ url('/invoice/'.$order_id) }}">here</a>.<br/><br/>

            We’re excited to have you join us. Please keep this email for your reference. If you have any questions, feel free to reply to this message.<br/>

            Looking forward to seeing you there!
        </p>

    </div>
@stop

