@extends('site.app')
@section('title', $page_header)
@section('description', str_limit(strip_tags($sitedetail->meta_description), 200) )
@section('fb_url', Request::url())
@section('fb_image', asset($sitedetail->fb_image))
@section('keywords', $sitedetail->meta_keywords)
@section('main-content')
<section class="inner__content">
	<div class="single__content">
		<div class="container">
			@include('site.components.pagedetail-ads')
			<div class="row">
				<div class="col* col-md-8 col-lg-8 col-xl-9">
					@include('site.components.pagedetail-sub-head-ads')
					
					<div class="contact__infos">
						<h1 class="titleHead-1">सम्पर्क गर्नुहोस्</h1>
						<p>हामीलाई तपाईंको प्रश्न पठाउनुहोस् र हामी चाँडै सम्पर्क गर्नेछौं</p>
						<div class="contactDetailsBox">
							<ul class="list-unstyled">
								<li>
									<div class="fotContactIcon">
										<i class="las la-map-marker"></i>
									</div>
									<div class="fotContactInfos">
										<span>{{ $sitedetail->title_en }}  : </span>
										<p>प्रधान कार्यलय: {{ $sitedetail->address_en }}</p>
									</div>
								</li>
								@if($sitedetail->mobile_no != '')
								<li>
									<div class="fotContactIcon">
										<i class="las la-phone-volume"></i>
									</div>
									<div class="fotContactInfos">
										<span>सम्पर्क : </span>
										<p><a href="tel:{{ $sitedetail->mobile_no }}">{{ $sitedetail->mobile_no }}</a></p>
									</div>
								</li>
								@endif
								@if($sitedetail->email != '')
								<li>
									<div class="fotContactIcon">
										<i class="las la-envelope-open"></i>
									</div>
									<div class="fotContactInfos">
										<span>इमेल : </span>
										<p><a href="mailto:{{ $sitedetail->email }}">{{ $sitedetail->email }}</a></p>
									</div>
								</li>
								@endif
							</ul>
						</div>
						@include('site.components.facebook')
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