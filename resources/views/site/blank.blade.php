@extends('site.app')
@section('title', $page_header)
@section('description', str_limit(strip_tags($sitedetail->meta_description), 200) )
@section('fb_url', Request::url())
@section('fb_image', asset($sitedetail->fb_image))
@section('keywords', $sitedetail->meta_keywords)
@section('breadcrumbs')
<section class="breadcrumbs">
	<div class="breadcrumb__flex">
		<div class="container breadcrumb__right">
			<nav class="default__breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="ri-home-4-line"></i></a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ $page_header }}</li>
				</ol>
			</nav>
		</div>
	</div>
</section>
@endsection
@section('main-content')
<section class="common__section">
	<div class="container">
		@include('site.components.pagedetail-ads')
		<div class="row no-gutters">
			<div class="col* col-md-8 col-lg-8 col-xl-9">
				<div class="detail__post__infos">
					<h2 class="detail__post__title">{{ $page_header }}</h2>
				</div>
			</div>
			<div class="col* col-md-4 col-lg-4 col-xl-3">
				<div class="side__bar">
					@include('site.components.recentnews')
					@include('site.components.facebook')
				</div>
			</div>
		</div>
	</div>
</section>
@endsection