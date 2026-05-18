@extends('email.home')
@section('header')
    @section('css')
        <style>
        </style>
    @stop
@stop
@section('content')
    <div class="col-md-12">
        <h2>Dear {{ $name }},</h2>
        <p>Thank you for upgrading to a <b>{{ $membership_type }} Membership</b> with Jewellery Networking! ✨<br/><br/>
            We’re excited to have you at this new level of engagement.<br/><br/>
            As a {{ $membership_type }} member, you now enjoy:<br/>
            {!! $benefits !!}<br/><br/>
            Your membership is valid until {{ $expiry_date }}.<br/>
            Your order ID is <b>{{ $order_id }}.</b><br/>
            Please download the invoice <a href="{{ url('/invoice/'.$order_id) }}">here</a>.<br/><br/>

            We look forward to seeing you make the most of these new privileges and continue building valuable connections within our community.<br/>
            👉 You can manage your membership and explore {{ $membership_type }} features <a href="{{ url('/') }}">here</a>.<br/>
            Welcome again — and thank you for being a key part of our growing jewellery network!</p>

    </div>
@stop

