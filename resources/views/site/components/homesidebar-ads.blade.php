<?php

use App\Model\site\Home;
$list = Home::getAdvertisementList($type='hp-s1',$limit=6);
$count = 1;
?>
    @if(count($list)>0)
    @foreach($list as $kl => $ads)
<div class="promo__col">
        <a href="{{ $ads->url }}" title="{{ $ads->title }}" target="_blank">
            <img src="{{ asset($ads->image) }}" class="w-100" alt="{{ $ads->title }}">
        </a>
</div>
    @endforeach
    @endif