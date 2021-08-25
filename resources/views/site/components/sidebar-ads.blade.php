<?php
use App\Model\site\Home;
$list = Home::getAdvertisementList($type='dp-s1');
$count = 1;
?>
<div class="side__bar">
	@if(count($list)>0)
	@foreach($list as $kl => $ads)
	<div class="promo__col">
		<a href="{{ $ads->url }}" title="{{ $ads->title }}" target="_blank">
			<img src="{{ asset($ads->image) }}" class="w-100" alt="{{ $ads->title }}">
		</a>
	</div>
	@endforeach
	@endif
</div>