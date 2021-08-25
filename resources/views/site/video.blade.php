@extends('site.app')
@section('title', $page_header)
@section('description', str_limit(strip_tags($sitedetail->meta_description), 200) )
@section('fb_url', Request::url())
@section('fb_image', asset($sitedetail->fb_image))
@section('keywords', $sitedetail->meta_keywords)
@section('main-content')
<section class="inner__content">
	<div class="video__content">
		<div class="container">
			@include('site.components.pagedetail-ads')
			
			<div class="row">
				<div class="col* col-md-8 col-lg-8 col-xl-9">
					{{-- @include('site.components.pagedetail-sub-head-ads') --}}
					<div class="title__headFlex">
						<div class="news__title">
							<h2>{{ $page_header }}</h2>
						</div>
						
						<div class="read__more">
{{-- 							<a href="#" class="btn btn-1">सबै</a>
 --}}						</div>
					</div>
					<div class="video__wrap">
						<div class="slider-container">
							<div id="slider" class="slider owl-carousel">
								@foreach($list as $item)
								<div class="item">
									<div class="embed-responsive embed-responsive-16by9">
										<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $item->youtube_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									</div>
								</div>
								@endforeach
							</div>
							
							
							
							<!-- <div class="slider-controls">
								<a class="slider-left" href="javascript:;"><span><i class="fa fa-2x fa-chevron-left"></i></span></a>
								<a class="slider-right" href="javascript:;"><span><i class="fa fa-2x fa-chevron-right"></i></span></a>
							</div>  -->
						</div>
						
						<div class="thumbnail-slider-container">
							<div id="thumbnailSlider" class="thumbnail-slider owl-carousel">
								@foreach($list as $item)
								<div class="item">
									<img src="{{ getImage($item->image) }}" class="img-responsive" alt="{{ $item->title }}">
								</div>
								@endforeach
							</div>
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