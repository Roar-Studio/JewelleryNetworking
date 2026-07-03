@extends('deitiesdesignawards.layouts.app')

@section('title', 'Design Category | Deities Design Awards')

@section('content')

<section class="page-hero-int">
    <div class="page-hero-int-content">
        <span class="page-hero-int-eyebrow">Categories</span>
        <h1 class="page-hero-int-title">Design Category</h1>
    </div>
</section>

<section class="section" style="background:var(--ivory)">
    <div class="container" style="max-width:760px;text-align:center">
        <span class="section-eyebrow" style="justify-content:center">Coming Soon</span>
        <h2 class="section-title" style="margin-bottom:24px">Design categories are<br><em>being curated.</em></h2>
        <p style="font-family:var(--body);font-size:16px;color:var(--brown-soft);line-height:1.8;max-width:560px;margin:0 auto 48px">
            We are carefully shaping the Design Category to celebrate the finest expressions of sacred jewellery design. Details will be announced soon — stay tuned.
        </p>
        <a href="{{ url('/deitiesdesignawards/contact') }}" class="btn-outline">
            <span>Be Notified</span>
            <span class="arrow">&rarr;</span>
        </a>
    </div>
</section>

@endsection