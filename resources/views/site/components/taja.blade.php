<?php
use App\Model\site\Home;
$list = Home::getAllLatestPostList($limit=7);
$count = 1;
?>
<div class="side__bar">
    <div class="side__col">
        <h3>लाइभ अपडेट</h3>
    </div>
    <div class="trending__box trending___list">
        <ul class="list-unstyled">
            @if(!empty($list))
            @foreach($list as $k => $item)
            <li>
                <span>{!! changeEngToNepali($count++)  !!}.</span><a href="{{ route('post.detail',$item->slug) }}">{{ str_limit($item->title,50) }}</a>
            </li>
            @endforeach
            @endif
            
        </ul>
    </div>
</div>