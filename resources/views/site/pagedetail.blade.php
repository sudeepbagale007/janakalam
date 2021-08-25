@extends('site.app')
<?php
	if ($detail->fb_image != '') {
		$fbimage = $detail->fb_image;
	}else {
		if ($detail->image != '') {
			$fbimage = $detail->fb_image;
		}else{
			$fbimage = $sitedetail->fb_image;
		}
	}
?>
@section('title', $detail->title)
@section('description', str_limit(strip_tags($detail->description), 200) )
@section('fb_url', Request::url())
@section('fb_published_date', $detail->published_date )
@section('fb_image', asset($fbimage))
@section('keywords', $sitedetail->meta_keywords)
@section('main-content')
<section class="inner__content">
	<div class="single__content">
		<div class="container">
			@include('site.components.pagedetail-ads')
			
			<div class="row">
				<div class="col* col-md-8 col-lg-8 col-xl-9">
					{{-- @include('site.components.pagedetail-sub-head-ads') --}}
					<div class="single__detail">
						{!!$detail->description!!}
					</div>
				</div>
				<div class="col* col-md-4 col-lg-4 col-xl-3">
					@include('site.components.mostpopular')
					@include('site.components.sidebar-ads')
				</div>
			</div>
		</div>
	</div>
</section>
@endsection