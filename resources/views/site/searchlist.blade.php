@extends('site.app')
@section('title', $page_header)
@section('description', str_limit(strip_tags($sitedetail->meta_description), 200))
@section('fb_url', Request::url())
@section('fb_image', asset($sitedetail->fb_image))
@section('keywords', $sitedetail->meta_keywords)
@section('main-content')
<section class="inner__content">
	<div class="container">
		<div class="page__title__list">
			<h3 class="head__title">{{ $page_header.' result of : '. $search }}</h3>

		</div>
		@if(count($list)>0)
		<div class="bottom__list__news">
			<div class="row no-gutters">
				@foreach($list as $kl => $item)
				<div class="col* col-sm-6 col-md-4 col-lg-3 news__list1">
					<div class="news__md--1">
					    @if($item->image)
						<figure>
							<a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
								<img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title="{{ $item->title }}">
							</a>
						</figure>
						@endif
						
						<div class="news__infos__md">
							<h3>
							<a href="{{ route('post.detail',$item->slug) }}"> {{ str_limit($item->title,100) }}</a>
							</h3>
							<div class="post__time--1">
								<i class="las la-clock"></i> <span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($item->published_date)->diffForHumans()) !!}</span>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				
			</div>
		</div>
		<div class="pagination__wrap">
			{{ $list->appends(Request::only('search'))->links('vendor.pagination.default') }}
		</div>
		@endif
	</div>
</section>
@endsection