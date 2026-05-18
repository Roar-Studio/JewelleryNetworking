@extends('frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('new_ui/assets/css/order.css') }}?v={{ time() }}">
<style>
.social-icon-header a svg path{
    fill: #fff;
}
section.product-table * {
    font-family: 'Lato';
}
</style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div id="carouselExampleCaptions" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('new_ui/assets/images/order_summary_header.png') }}" class="d-block w-100 desktop_view" alt="carousel image">
            <img src="{{ asset('new_ui/assets/images/order_summary_mobile_banner.webp') }}" class="d-block w-100 mobile_view" alt="carousel image">
        </div>
    </div>

</div>

<div class="container">
    <h1 class="main-page-title">
        @if($txn->status === 'failed')
            Payment Cancelled
        @elseif($txn->status === 'success')
            Payment Successful
        @else
            Payment Status
        @endif
    </h1>
</div>

<div class="special-design mt-2" style="height: 100px;">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}" alt="Product Image">
    <div class="vertical-line"></div>
</div>

<section class="main-section-outer">
    <h2 class="main-section-title">
        @if($txn->status === 'failed')
            Payment Failed
        @elseif($txn->status === 'success')
            Payment Successful
        @else
            Payment Status
        @endif
    </h2>

    <p class="" style="color: #000; font-size: 16px;">
        @if($txn->status === 'failed')
            Your payment for <strong>{{ ucwords($txn->product_name) }}</strong> has been failed.
        @elseif($txn->status === 'success')
            Your payment for <strong>{{ ucwords($txn->product_name) }}</strong> was successful.
        @else
            Status of your payment for <strong>{{ $txn->product_name }}</strong> is <strong>{{ ucfirst($txn->status) }}</strong>.
        @endif
    </p>

    <div class="transaction-details mb-4">
        <p class="mb-0"><strong>Order ID:</strong> {{ $txn->order_id }}</p>
        <p class="mb-0"><strong>Transaction Date:</strong> {{ $txn->transaction_date }}</p>
        <p class="mb-0"><strong>Payment Method:</strong> {{ ucfirst($txn->payment_method) }}</p>
        <p class="mb-0"><strong>Total Amount:</strong> {{ $txn->currency_type === 'INR' ? '₹' : '$' }}{{ number_format($txn->total_amount, 2) }}</p>
        
    </div>

    <a href="/" class="btn btn-primary custom-btn mb-4">
        Go to Homepage
        <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
        </svg>
    </a>
</section>
<!-- END: Content-->
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('new_ui/assets/js/admin/custom-image-uploader.js') }}?v={{ time() }}"></script>
@endsection
