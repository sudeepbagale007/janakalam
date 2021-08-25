<?php
use App\Model\site\Home;
$list = Home::getPopularNewsList($limit=8);
$count = 1;
?>
@if(count($list)>0)
<div class="side__bar">
    <div class="side__col">
        <h3>सर्वाधिक पढिएको</h3>
    </div>
    <div class="trending__box trending___list1">
        <ul class="list-unstyled">
            @foreach($list as $k => $item)
            <li>
                <div class="post__time--1">
                    <i class="las la-clock"></i> <span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($item->published_date)->diffForHumans()) !!}</span>
                </div>
                <a href="{{ route('post.detail',$item->slug) }}">{{ str_limit($item->title,100) }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endif