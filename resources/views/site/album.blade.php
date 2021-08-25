@extends('site.app')
@section('title', $page_header)
@section('description', str_limit(strip_tags($sitedetail->meta_description), 200) )
@section('fb_url', Request::url())
@section('fb_image', asset($sitedetail->fb_image))
@section('keywords', $sitedetail->meta_keywords)
@section('main-content')
<section class="inner__content">
        <div class="single__content">
          <div class="container">
            @include('site.components.pagedetail-ads')
            <div class="row">
              <div class="col* col-md-8 col-lg-8 col-xl-9">
                <div class="page__title__list">
                  <h3>फोटो ग्यालेरी</h3>
                </div>

                <div class="gallery__list">
                  <div class="row no-gutters">
                    @foreach($albums as $item)
                    <div class="col* col-sm-6 col-md-4 col-lg-4 news__list1">
                      <div class="news__md--1">
                        <figure>
                          <a href="{{ route('albumSingle',$item->slug) }}" title="title">
                           <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title="{{ $item->title }}">
                          </a>
                        </figure>
                      
                        <div class="news__infos__md">
                          <h3>
                            <a href="{{ route('albumSingle',$item->slug) }}">{{ $item->title }}</a>
                          </h3>
                          <div class="post__time--1">
                            <i class="las la-clock"></i> <span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($item->created_at)->diffForHumans()) !!}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
                
              </div>

              <div class="col* col-md-4 col-lg-4 col-xl-3">
                
                @include('site.components.mostpopular')
          @include('site.components.sidebar-ads')


              </div>


            </div>
          </div>
        </div>
      </section>
      @endsection