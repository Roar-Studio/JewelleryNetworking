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
        
        <p>
            We’ve loved having you as part of our vibrant Jewellery Networking community.<br><br>

            Your {{ $membership_type }} Membership 
            @if($status === 'expired')
                <strong>has expired on {{ $expiry_date }}</strong>.
            @else
                <strong>will expire on {{ $expiry_date }}</strong>.
            @endif
            <br><br>

            As a member, you’ve had access to:<br>
            {!! $benefits !!} {{-- Render raw HTML --}}
            <br><br>

            We’d love to have you continue as an active member of the community.<br><br>

            👉 Renew your membership today to stay connected and make the most of upcoming opportunities:<br>
            <a href="{{ url('/membership') }}" style="display:inline-block;padding:10px 20px;background:#264C5A;color:#fff;text-decoration:none;">
                Renew Membership
            </a><br><br>

            Thank you for being part of our network — your participation enriches the community for everyone.
        </p>
    </div>
@stop
