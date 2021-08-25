@extends('site.app')
@section('title', $page_header)
@section('description', str_limit(strip_tags($sitedetail->meta_description), 200) )
@section('fb_url', Request::url())
@section('fb_image', asset($sitedetail->fb_image))
@section('keywords', $sitedetail->meta_keywords)
@section('main-content')
<section class="gallery__col section__top">
  <div class="container">
    <div class="title__headFlex">
      <div class="news__title">
        <h2> फोटो ग्यालेरी / {{ $album->title }}</h2>
      </div>
    </div>
    <div class="gallery__col commonGutters">
        @if(count($photos)>0)
      <div class="row no-gutters">
        <div class="col* col-md-7 col-lg-7 gallery__left">
          <figure>
            <a data-fancybox="gallery" href="{{ getImage($photos[0]->image) }}" data-caption="{{ $photos[0]->title }}">
              <img src="{{ getImage($photos[0]->image) }}" class="w-100" alt="{{ $photos[0]->title }}" title="{{ $photos[0]->title }}">
            </a>
          </figure>
        </div>
        <div class="col* col-md-5 col-lg-5 gallery__right">
          <div class="row no-gutters">
        @foreach($photos as $k=>$item)
          @if($k >= 1)
            <div class="col* col-md-6 col-lg-6 gallery__sub">
              <figure>
                <a data-fancybox="gallery" href="{{ getImage($item->image) }}" data-caption="{{ $item->title }}">
                  <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title="{{ $item->title }}">
                </a>
              </figure>
            </div>
            @endif
        @endforeach
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</section>
@endsection