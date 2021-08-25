@if(count($list) == 1)
<section class="promotional__col section__top">
    <div class="container">
    	<a href="{{ $list[0]->url }}" target="_blank" title="{{ $list[0]->title }}">
    		<img src="{{ getImage($list[0]->image) }}"  class="w-100" alt="{{ $list[0]->title }}">
    	</a>
    </div>
</section>

@elseif(count($list) == 2)
<section class="promotional__col section__top">
    <div class="container">
        <div class="row no-gutters">
        	@foreach($list as $k => $item)
              <div class="col* col-md-6 col-lg-6 mb-2">
                <a href="{{ $item->url }}" target="_blank" title="{{ $item->title }}">
                    <img src="{{ getImage($item->image) }}"  class="w-100" alt="{{ $item->title }}">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>







@elseif(count($list) == 3)
<section class="axdvertisement axdvertisement__3col mt-40">
    <div class="container">
        <div class="row">
        	@foreach($list as $k => $item)
            <div class="col* col-md-4 col-lg-4">
                <a href="{{ $item->url }}" target="_blank" title="{{ $item->title }}">
                    <img src="{{ getImage($item->image) }}"  class="w-100" alt="{{ $item->title }}">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@else

@endif