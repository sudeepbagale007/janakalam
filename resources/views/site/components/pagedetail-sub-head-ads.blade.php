<?php
use App\Model\site\Home;
$list = Home::getAdvertisementList($type='dp-hs1');
$count = 1;
?>

@if(count($list)>0)
	@foreach($list as $kl => $ads)
	<div class="promo-detail">
		<a href="{{ $ads->url }}" title="{{ $ads->title }}" target="_blank">
			<img src="{{ asset($ads->image) }}" class="img-responsive" alt="{{ $ads->title }}">
		</a>
	</div>
	@endforeach
	@endif