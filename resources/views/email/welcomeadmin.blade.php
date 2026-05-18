@extends('email.home')

@section('header')
    @section('css')
        <style>
            p { font-size: 15px; line-height: 1.6; color: #333; }
            strong { color: #264C5A; }
        </style>
    @stop
@stop

@section('content')
    <div class="col-md-12">
        <h2>New Customer Registered!</h2>
        <p>
            A new customer has just registered on <strong>Jewellery Networking</strong>.
        </p>

        <p><strong>Customer Details:</strong></p>
        <ul>
            <li><strong>Full Name:</strong> 
                {{ trim(($customer->first_name ?? '') . ' ' . ($customer->last_name ?? '')) ?: 'N/A' }}
            </li>
            @if(!empty($membershipId))
                <li><strong>Membership ID:</strong> {{ $membershipId }}</li>
            @endif
            <li><strong>Email ID:</strong> {{ $customer->email ?? 'N/A' }}</li>
            <li><strong>Mobile No:</strong> 
                {{ $customer->mobile_no_cc && $customer->mobile_no ? $customer->mobile_no_cc . $customer->mobile_no : 'N/A' }}
            </li>
            <li><strong>Registered At:</strong> 
                {{ $customer->created_at ? $customer->created_at->format('d M Y, h:i A') : now()->format('d M Y, h:i A') }}
            </li>
        </ul>
        <p>
            To explore entire profile please login to admin panel
        </p>

        <p>
            <a href="{{ url('/admin/login') }}" style="display:inline-block;padding:10px 20px;background:#264C5A;color:#fff;text-decoration:none;border-radius:4px;">
                View in Admin Panel
            </a>
        </p>
        <br/>
        <br/>

    </div>
@stop
