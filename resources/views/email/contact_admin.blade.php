@extends('email.home')
@section('header')
    @section('css')
        <style>
        </style>
    @stop
@stop
@section('content')
    <div class="col-md-12">
        <h2>Dear Admin Team,</h2>
        <p>A new query has been submitted via the Contact Us page on Jewellery Networking. Below are the details:<br/><br/>
        Name: {{ $first_name }} {{ $last_name }}<br/>
        Email Address: {{ $email }}<br/>
        Company: {{ $company_name }}<br/>
        Phone Number: {{ $mobile_no }}<br/>
        Country: {{ $country }}<br/>
        Submitted On: {{ \Carbon\Carbon::parse($submission_date)->format('d-m-Y H:i A') }}<br/>
        Message:<br/>
        {{ $text_message }}<br/><br/>
        Suggested Action:<br/>
        Please review and respond to the user’s query at your earliest convenience.<br/><br/>
        Thank you,<br/>
        Jewellery Networking System Notification</p>
        
    </div>
@stop

