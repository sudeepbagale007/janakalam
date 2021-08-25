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
		<section class="adv__detail">
			<a href="#" ><img src="{{ getImage('site/images/adv13.gif') }}" class="img-responsive" alt="title"></a>
		</section>
		<div class="row no-gutters">
			<div class="col* col-md-8 col-lg-8 col-xl-9">
				<div class="post__widget">
					@if(!empty($list))
					@foreach($list as $k => $val)
					<div class="rule__post">
						<h3>{{ $val->title }}</h3>
						<b>{!! $val->description !!}</b>
						<ul class="list-unstyled">
							@if(!empty($val->chlidlist))
							<?php $count = 1; ?>
							@foreach($val->chlidlist as $kl => $item)
								<li>
									<span>{{ changeEngToNepali($count++) }}.</span><label>{{ $item->title }}</label>
								</li>
							@endforeach
							@endif
						</ul>
					</div>
					@endforeach
					@endif
				</div>
			</div>
			<div class="col* col-md-4 col-lg-4 col-xl-3">
				<div class="side__bar">
					@include('site.components.sidebar-ads')
				</div>
			</div>
		</div>
	</div>
</section>
@endsection