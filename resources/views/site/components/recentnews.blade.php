<?php
use App\Model\site\Home;
$list = Home::getAllLatestPostList($limit=6);
$count = 1;
?>
<div class="side__bar">
    <div class="side__news__latest sticky-top">
        <h2>Recent News</h2>
        <div class="side__latest__box trending___list">
            <ul class="list-unstyled">
                @if(!empty($list))
                @foreach($list as $k => $item)
                    <li>
                        <div class="media">
                            <figure class="avatar mr-2">
                                <img src="{{ getImage($item->image) }}" class="rounded-circle" alt="{{ $item->title }}" title="{{ $item->title }}">
                            </figure>
                            <div class="media__latest--infos">
                                <div class="post__time post__label mb-1">
                                    <i class="ri-time-line"></i> {!! changeEngHumanDateToNepali(Carbon\Carbon::parse($item->published_date)->diffForHumans()) !!}
                                </div>
                                <a href="{{ route('post.detail',$item->slug) }}">{{ str_limit($item->title,50) }}</a>
                            </div>
                        </div>
                    </li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>