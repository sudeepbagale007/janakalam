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
					<div class="single__detail">
						<div class="unicode__wrap">
							<iframe style="border: none; height: 540px; width: 100%;" src="https://unicode.toolsnepal.com/pu.html" frameborder="0"></iframe>
						</div>
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