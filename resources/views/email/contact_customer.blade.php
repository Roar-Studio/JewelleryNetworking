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
        <p>Thank you for reaching out to us via the Contact Us page on Jewellery Networking.<br/><br/>
        We have received your message and our team will review it shortly.<br/><br/>
        A member of our team will get back to you within 1–2 business days.<br/>
        In the meantime, feel free to explore our community and resources on <a href="https://www.jewellerynetworking.com">Jewellery Netwroking Website</a><br/><br/>
        We appreciate your interest and engagement in our jewellery network!</p>


    </div>
@stop

