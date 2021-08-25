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
          @if(!empty($list[0]))
				<div class="col* col-md-6 col-lg-4 news__list--inner">
					<a href="{{ route('post.detail',$list[0]->slug) }}" class="news__link" title="{{ $list[0]->title }}">
						<div class="big__img">
						    @if($list[0]->image)
							<figure>
								<img src="{{ getImage($list[0]->image) }}" class="w-100" alt="{{ $list[0]->title }}" title="{{ $list[0]->title }}">
							</figure>
							@endif
							<h2 class="news__title--lg">{{ str_limit($list[0]->title,100) }}</h2>
							<p>{!! str_limit(strip_tags($list[0]->description),200) !!}</p>
						</div>
					</a>
				</div>
				@endif
				<div class="col* col-md-6 col-lg-4 news__list--inner">
					<div class="news__list">
						@foreach($list as $kl => $item)
						@if($kl >= 1 && $kl <=4)
						<div class="news__blockList">
							<div class="news__flex news__img--md">
							    @if($item->image)
								<figure>
									<a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
										<img src="{{ getImage($item->image) }}" class="w-100 h-100" alt="{{ $item->title }}" title="{{ $item->title }}">
									</a>
								</figure>
								@endif
								
								<div class="news__infos">
									<h3 class="news__title--sm"><a href="{{ route('post.detail',$item->slug) }}"> {{ str_limit($item->title,100) }}</a></h3>
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
				<div class="col* col-md-6 col-lg-4 news__list--inner">
					<div class="news__list">
						@foreach($list as $kl => $item)
						@if($kl >= 5 && $kl <=8)
						<div class="news__blockList">
							<div class="news__flex news__img--md">
							    @if($item->image)
								<figure>
									<a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
										<img src="{{ getImage($item->image) }}" class="w-100 h-100" alt="{{ $item->title }}" title="{{ $item->title }}">
									</a>
								</figure>
								@endif
								
								<div class="news__infos">
									<h3 class="news__title--sm"><a href="{{ route('post.detail',$item->slug) }}"> {{ str_limit($item->title,100) }}</a></h3>
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
				
			</div>
		</div>
		<div class="bottom__list__news">
			<div class="row no-gutters">
				
				@foreach($list as $kl => $item)
				@if($kl >8)
				<div class="col* col-sm-6 col-md-4 col-lg-3 news__list1">
					<div class="news__md--1">
						<figure>
							<a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
								<img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title="{{ $item->title }}">
							</a>
						</figure>
						
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