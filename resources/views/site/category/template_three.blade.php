@extends('site.app')
@section('title', $category->title)
@section('description', str_limit(strip_tags($sitedetail->meta_description), 200) )
@section('fb_url', Request::url())
@section('fb_image', asset($sitedetail->fb_image))
@section('keywords', $sitedetail->meta_keywords)
@section('main-content')
<section class="inner__content">
	<div class="container">
		<div class="page__title__list">
			<h3>{{ $category->title }}</h3>
		</div>
		@if(count($list)>0)
		<div class="top__list__news">
			<div class="row">
				<div class="col* col-sm-7 col-md-8 col-lg-9 news__list2">
		          @if(!empty($list[0]))
					<div class="row no-gutters">
						<div class="col* col-sm-6 col-md-6 col-lg-6 img-height">
						    @if($list[0]->image)
							<figure>
								<img src="{{ getImage($list[0]->image) }}" class="w-100" alt="{{ $list[0]->title }}">
							</figure>
							@endif
						</div>
						<div class="col* col-sm-6 col-md-6 col-lg-6">
							<div class="news__infos__md">
								<h3>
								<a href="{{ route('post.detail',$list[0]->slug) }}"> {{ str_limit($list[0]->title,100) }}</a>
								</h3>
								<div class="post__time--1 mb-3">
									<i class="las la-clock"></i> <span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($list[0]->published_date)->diffForHumans()) !!}</span>
								</div>
								<p>{!! str_limit(strip_tags($list[0]->description),200) !!}</p>
							</div>
						</div>
					</div>
					@endif
				</div>
				<div class="col* col-sm-5 col-md-4 col-lg-3 news__list2">
					<div class="post__list__text post__list__custom">
						<ul class="list-unstyled list__border">
							@foreach($list as $kl => $item)
							@if($kl >= 1 && $kl <=3)
							<li>
								<div class="post__time post__label">
									<span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($item->published_date)->diffForHumans()) !!}</span>
								</div>
								<a href="{{ route('post.detail',$item->slug) }}"> {{ str_limit($item->title,100) }}</a>
							</li>
							@endif
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom__list__news">
			<div class="row no-gutters">
				@foreach($list as $kl => $item)
				@if($kl >3)
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
				@endif
				@endforeach
				
			</div>
		</div>
		<div class="pagination__wrap">
			{{ $list->links('vendor.pagination.default') }}
		</div>
		@endif
	</div>
</section>
@endsection