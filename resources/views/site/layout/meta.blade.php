<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>@yield('title') - || {{ $sitedetail['title_en'] }} ||</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" type="text/css"/>
<link rel="apple-touch-icon" sizes="any" href="{{ $sitedetail->logo }}">
<link rel="icon" type="image/png" href="{{ $sitedetail->logo }}" sizes="any">


{{-- meta --}}
<meta name="theme-color" content="#ffffff">
<meta name="keywords" content="@yield('keywords')"/>
<meta name="description" content="@yield('description')"/>
<link rel="canonical" href="{{ Request::url() }}"/>
<meta name="Classification" content="Article">

<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="|| @yield('title') || {{ $sitedetail->site_title }}"/>
<meta property="og:description" content="@yield('description')"/>
<meta property="og:url" content="@yield('fb_url')"/>
<meta property="og:site_name" content="{{ route('index') }}"/>
<meta property="og:image" content="@yield('fb_image')"/>

<meta property="article:section" content="Featured"/>
<meta property="article:published_time" content="{{ date('Y-m-d H:i:s') }}"/>

<meta name="twitter:card" content="summary"/>
<meta name="twitter:description" content="@yield('description')"/>
<meta name="twitter:title" content="|| @yield('title') || {{ $sitedetail->site_title }}"/>
<meta name="twitter:site" content="{{ $sitedetail->twitter }}"/>
<meta name="twitter:domain" content="{{ route('index') }}"/>
<meta name="twitter:image" content="@yield('fb_image')"/>
<meta name="twitter:creator" content="{{ $sitedetail->twitter }}"/>

<meta name="Language" content="English">
<meta http-equiv="cache-control" content="private">
<!--<meta name="Copyright" content="Candid Nepal IT Solutions Pvt. Ltd">
<meta name="Publisher" content="Candid Nepal IT Solutions Pvt. Ltd.">-->

<meta name="coverage" content="Worldwide">
<meta name="distribution" content="Global">
<meta name="rating" content="General">
<meta name="revisit-after" content="7 days">
<meta http-equiv="Expires" content="0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">

<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- meta --}}

<!--Bootstrap CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('site/css/style.css', $secure = null) }}">
<link rel="stylesheet" type="text/css" href="{{ asset('site/css/custom.css', $secure = null) }}">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

@stack('vi_style')