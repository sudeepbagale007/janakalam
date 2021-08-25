@extends('site.app')
@section('title', $category->title)
@section('description', str_limit(strip_tags($sitedetail->meta_description), 200) )
@section('fb_url', Request::url())
@section('fb_image', asset($sitedetail->fb_image))
@section('keywords', $sitedetail->meta_keywords)
@section('main-content')
<section class="inner__content">
  <div class="container">
    <div class="page__title__list">
      <h3>{{ $category->title }}</h3>
    </div>
    @if(count($list)>0)
    <div class="post__content__list">
      <div class="row no-gutters">
        @foreach($list as $kl => $item)
        <div class="col* col-sm-6 col-md-6 col-lg-4 list__post">
          <div class="bg__box">
            <div class="bichar__post__list bichar__post__2">
              <h3 class="post__title"><a href="{{ route('post.detail',$item->slug) }}">{{ str_limit($item->title,100) }}</a></h3>
              <div class="media">
                  @if($item->image)
                <figure class="avatar mr-2">
                  <img src="{{ getImage($item->image) }}" class="rounded-circle" alt="{{ $item->title }}" title="{{ $item->title }}">
                </figure>
                @endif
                <div class="media__bichar--infos">
                  <p>{!! str_limit(strip_tags($item->description),200) !!}</p>
                  @if($item->interviewer_name)
                  <label class="post__autor__bichar">- {{ $item->interviewer_name }}</label>
                  @endif
                </div>
                
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="pagination__wrap">
        {{ $list->links('vendor.pagination.default') }}
      </div>
    </div>
    @endif
  </div>
</section>
@endsection