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
    
      @if(!empty($list))
    <div class="top__list__news">
      <div class="news__img--single commonGutters">
        <div class="row no-gutters">
      @if(!empty($list[0]))
          <div class="col* col-md-7 col-lg-6 single--img">
            <div class="featureImg bigImg">
              <div class="mainBigImg featureBgImg itemAfter" 
              @if($list[0]->image)
              style="background: url({{ getImage($list[0]->image) }});background-size: cover;background-repeat: no-repeat;background-position: center;"
              @endif
              >
                <div class="featureOverlay"></div>
                
                <div class="featureBgInfos">
                  <h2><a href="{{ route('post.detail',$list[0]->slug) }}"> {{ str_limit($list[0]->title,100) }}</a></h2>
                  <p> {!! str_limit(strip_tags($list[0]->description),200) !!}</p>
                </div>
                
              </div>
            </div>
          </div>
          @endif
          
          <div class="col* col-md-5 col-lg-6 single--img1">
          @if(!empty($list[1]))
            <div class="featureImg smallImg">
              <div class="mainBigImg featureBgImg itemAfter" 
              @if($list[1]->image)
              style="background: url({{ getImage($list[1]->image) }});background-size: cover;background-repeat: no-repeat;background-position: center;"
              @endif
              >
                <div class="featureOverlay"></div>
                
                <div class="featureBgInfos">
                  <h3><a href="{{ route('post.detail',$list[1]->slug) }}" class="postTitle"> {{ str_limit($list[1]->title,100) }}</a></h3>
                  <p>{!! str_limit(strip_tags($list[1]->description),150) !!}</p>
                </div>
              </div>
            </div>
            @endif
            
            <div class="ftImgBtm">
              <div class="row no-gutters">
                @foreach($list as $kl => $item)
                @if($kl >= 2 && $kl <=3)
                <div class="col* col-md-6 col-lg-6 smallNewsFeature">
                  <div class="featureImg smallImg">
                    <div class="mainBigImg featureBgImg itemAfter" 
                    @if($item->image)
                    style="background: url({{ getImage($item->image) }});background-size: cover;background-repeat: no-repeat;background-position: center;"
                    @endif
                    >
                      <div class="featureOverlay"></div>
                      
                      <div class="featureBgInfos">
                        <h3><a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}" class="postTitle">{{ str_limit($item->title,100) }}</a></h3>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
                
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <div class="bottom__list__news">
      <div class="row no-gutters">
        @foreach($list as $kl => $item)
        @if($kl >3)
        <div class="col* col-sm-6 col-md-4 col-lg-3 news__list1">
          <div class="news__md--1">
              @if($item->image)
            <figure>
              <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
                <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title="{{ $item->title }}">
              </a>
            </figure>
            @endif
            
            <div class="news__infos__md">
              <h3>
              <a href="{{ route('post.detail',$item->slug) }}"> {{ str_limit($item->title,100) }}</a>
              </h3>
              <div class="post__time--1">
                <i class="las la-clock"></i> <span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($item->published_date)->diffForHumans()) !!}</span>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
    <div class="pagination__wrap">
      {{ $list->links('vendor.pagination.default') }}
      
    </div>
    @endif
  </div>
</section>
@endsection