<?php
use App\Model\site\Home;
$list = Home::getAllLatestPostList($limit=10);
$count = 1;
?>
@if(count($list)>0)
<div class="side__col">
          <h3>ट्रेन्डिङ</h3>
        </div>
        <div class="trending__box trending___list">
          <ul class="list-unstyled">
            @foreach($list as $k => $item)
            <li>
              <span>{!! changeEngToNepali($count++)  !!}.</span><a href="{{ route('post.detail',$item->slug) }}">{{ str_limit($item->title,100) }}</a>
            </li>
            @endforeach
          </ul>
        </div>
@endif
