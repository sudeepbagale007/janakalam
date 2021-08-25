<?php

use App\Model\site\Home;

$topads = Home::getAdvertisement('dp-f1');

?>
@if(!empty($topads))
<div class="promo_page mt-30">
<a href="{{ $topads->url }}" target="_blank" title="{{ $topads->title }}" ><img src="{{ getImage($topads->image) }}" class="img-responsive" alt="{{ $topads->title }}"></a>
</div>
@endif