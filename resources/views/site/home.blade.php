@extends('site.app')
@section('title', $page_header)
@section('description', $sitedetail->meta_descriptions)
@section('keywords', $sitedetail->meta_keywords)
@section('fb_url', Request::url())
@section('fb_image', $sitedetail->fb_image)
@section('breadcrumbs')
{{-- ads --}}
{!! getHomeAdvertisement('hp1') !!}
{{-- @include('site.components.corona-live') --}}
@endsection
@section('main-content')
{{-- main news --}}

@if(session('answer'))
  <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)" class="container alert alert-success my-4" role="alert">
    {{session('answer')}}
    </div>
@endif

@if(!empty($windowpopup))
    @foreach ($windowpopup as $windowpopup)
    <div class="modal fade mt-5" style="display: flex; justify-content: center; align-items: center;" id="roadblockModal" tabindex="-1" role="dialog" aria-labelledby="roadblockModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content mt-5">
                <button type="button" class="close btn btn-danger pull-left" data-dismiss="modal" value="Skip" aria-label="Close" aria-hidden="true"
                style="background: #EC0813;position:absolute;top:-36px;padding:10px;color:white;opacity:1">
                    <span style="font-size:18px">SKIP</span>
                  </button>
              <div class="modal-body p-sm-5">
                  <a href="{{ $windowpopup->image}}" target="_blank">
                      <img class="img-responsive" src="{{ $windowpopup->image}}" style="display: block;margin-left: auto;margin-right: auto;">
                  </a>
              </div>
          </div>
      </div>
    </div>    
    @endforeach
@endif

<section class="live__video section__top">
  @if(!empty($videoPosts))
  <div class="container">
    <div class="row">
      @foreach($videoPosts as $post)
      @if($post->video_type_id=='1')
      <div class="col* col-md-12 col-lg-12">
        <h2 class="post__title global__title text-left mb-3">{{ $post->title }}</h2>
        <div class="embed-responsive embed-responsive-21by9 live__videoBox">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $post->video_url }}" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
      @endif
      @if($post->video_type_id=='2')
      <div class="col* col-md-12 col-lg-12 mt-5">
        <h2 class="post__title global__title text-left mb-3">{{ $post->title }}</h2>
        <div class="live__videoBox">
          <iframe src="https://www.facebook.com/plugins/video.php?href={{ $post->video_url }}%2F&show_text=1&width=560" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" allowFullScreen="true"></iframe>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
  @endif
</section>
<!--<section class="breakingNews section__top">-->
<!--  <div class="container">-->
    
<!--      <div class="breakings">-->
          
<!--    @if(!empty($breakingnews))-->
<!--    @foreach($breakingnews as $k => $item)-->
    
<!--    <div class="item"  style="display: flex; box-shadow: 0px 10px 30px rgba(0,0,0,0.1); padding: 30px; border-radius: 10px; gap: 30px; margin-bottom :30px">-->
        
    
<!--    @if($item->show_image == 1 && $item->image != '')-->
<!--      <figure style="flex:3">-->
<!--        <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" style="border-radius: 10px; height: 100%; object-fit:cover; object-position: center" title="{{ $item->title }}">-->
<!--      </figure>-->
<!--      @endif-->
      
<!--    <div class="breaking_news text-left" style="flex:5; margin:0; border: 0" >-->
<!--      <div class="breaking__col">-->
<!--          @if($item->short_text != '')-->
<!--        <div class="top__title">-->
<!--          <span class="theme__badge">{!! str_limit($item->short_text,50) !!} </span>-->
<!--        </div>-->
<!--        @endif-->
<!--        <a href="{{ route('post.detail',$item->slug) }}" title="News" class="breaking__title">{!! $item->title !!}</a>-->
<!--        <div class="post__infos__flex justify-content-start text-muted" style="gap: 15px">-->
<!--          <div class="post__author post__label">-->
<!--            <span>{{ authorName($item->author_name,$item->author_id) }}</span>-->
<!--          </div>-->
          
<!--          <div class="post__time post__label">-->
<!--            <i class="las la-clock"></i> <span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($item->published_date)->diffForHumans()) !!}</span>-->
<!--          </div>-->
<!--        </div>-->
<!--        @if($item->sub_heading != '')-->
<!--        <div class="breaking__shortInfos">{!! str_limit($item->sub_heading,100) !!}-->
<!--        </div>-->
<!--        @endif-->
<!--      </div>-->
      <!--<div class="head__desc">-->
      <!--  {!! str_limit(strip_tags($item->description),100) !!}-->
      <!--</div>-->
<!--    </div>-->
<!--     </div>-->
<!--    @endforeach-->
<!--    @endif-->
    
   
<!--    </div>-->
<!--  </div>-->
<!--</section>-->

<!--<section class="breakingNews section__top">-->
<!--  <div class="container">-->
<!--    <div class="breakings">-->
<!--      @if(!empty($stick_news))-->
<!--        @foreach($stick_news as $k => $item)-->
<!--        <div class="py-5">-->
<!--            <a class="d-flex justify-content-center font-weight-bold break-title text-center" href="{{ route('post.detail',$item->slug) }}" >{!! $item->title !!}</a>-->
<!--            <div class="d-flex flex-row justify-content-center my-5">-->
<!--              <div class="px-3">-->
<!--                <span>{{ authorName($item->author_name,$item->author_id) }}</span>-->
<!--              </div>  -->
<!--              <div class="px-3">-->
<!--                <i class="las la-clock"></i> <span>{!! changeFullDateTimeToNepaliFormat($item->published_date) !!}</span>-->
<!--              </div>  -->
<!--            </div> -->
<!--            @if($item->show_image == 1 && $item->image != '')-->
<!--              <img src="{{ getImage($item->image) }}" class="img-fluid w-100" title="{{ $item->title }}" alt="{{ $item->title }}"/>-->
<!--            @endif  -->
<!--          </div>  -->
<!--        @endforeach-->
<!--      @endif    -->
<!--    </div>-->
<!--  </div>    -->
<!--</section>-->


<section class="breakingNews section__top">
  <div class="container">
    <div class="breakings">
      @if(!empty($pin_news))
        @foreach($pin_news as $k => $item)
        <div class="py-5">
            <a class="d-flex justify-content-center font-weight-bold break-title text-center" href="{{ route('post.detail',$item->slug) }}" >{!! $item->title !!}</a>
            <div class="d-flex flex-row justify-content-center my-5">
              <div class="px-3">
                <span>{{ authorName($item->author_name,$item->author_id) }}</span>
              </div>  
              <div class="px-3">
                <i class="las la-clock"></i> <span>{!! changeFullDateTimeToNepaliFormat($item->published_date) !!}</span>
              </div>  
            </div> 
            @if($item->show_image == 1 && $item->image != '')
              <img src="{{ getImage($item->image) }}" class="img-fluid w-100" title="{{ $item->title }}" alt="{{ $item->title }}"/>
            @endif  
          </div>  
        @endforeach
      @endif    
    </div>
  </div>    
</section>

<section class="breakingNews section__top">
  <div class="container">
    <div class="breakings">
      @if(!empty($breakingnews))
        @foreach($breakingnews as $k => $item)
        <div class="py-5">
            <a class="d-flex justify-content-center font-weight-bold break-title text-center" href="{{ route('post.detail',$item->slug) }}" >{!! $item->title !!}</a>
            <div class="d-flex flex-row justify-content-center my-5">
              <div class="px-3">
                <span>{{ authorName($item->author_name,$item->author_id) }}</span>
              </div>  
              <div class="px-3">
                <i class="las la-clock"></i> <span>{!! changeFullDateTimeToNepaliFormat($item->published_date) !!}</span>
              </div>  
            </div> 
            @if($item->show_image == 1 && $item->image != '')
              <img src="{{ getImage($item->image) }}" class="img-fluid w-100" title="{{ $item->title }}" alt="{{ $item->title }}"/>
            @endif  
          </div>  
        @endforeach
      @endif    
    </div>
  </div>    
</section>

<!--<div class="container" style="margin-top: 10px">-->
<!--  <div class="row">-->
<!--    <div class="col-md-4 col-lg-3 mt-2">-->
<!--      <img src="{{asset('site/images/dashainads/1.png')}}" class="w-100 ">-->
<!--    </div>-->
<!--    <div class="col-md-4 col-lg-3 mt-2">-->
<!--      <img src="{{asset('site/images/dashainads/2.png')}}" class="w-100 ">-->
<!--    </div>-->
<!--    <div class="col-md-4 col-lg-3 mt-2">-->
<!--      <img src="{{asset('site/images/dashainads/3.png')}}" class="w-100 ">-->
<!--    </div>-->
<!--    <div class="col-md-4 col-lg-3 mt-2">-->
<!--      <img src="{{asset('site/images/dashainads/4.png')}}" class="w-100 ">-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->

<!--<section class="main__news section__top py-5 bg_p_dim text-left">-->
<!--  <div class="container">-->
<!--    @if(!empty($latestHome))-->
<!--    <div class="three__cols--grid">-->
<!--      <div class="col__span1">-->
<!--        <div class="news__list">-->
<!--          @foreach($latestHome as $kl => $item)-->
<!--          @if($kl >= 1 && $kl <=4)-->
<!--          <div class="news__blockList">-->
<!--            <div class="news__flex news__img--md d-flex text-left">-->
<!--                @if($item->image)-->
<!--              <figure style="flex:2">-->
<!--                <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">-->
<!--                  <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title="{{ $item->title }}">-->
<!--                </a>-->
<!--              </figure>-->
<!--              @endif-->
<!--              <div class="news__infos" style=" flex:4;">-->
<!--                <h3 class="news__title--sm"><a href="{{ route('post.detail',$item->slug) }}">{!! str_limit($item->title,52) !!}</a></h3>-->
<!--                <div class="post__time--1">-->
<!--                  <i class="las la-clock"></i> <span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($item->published_date)->diffForHumans()) !!}</span>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--          @endif-->
<!--          @endforeach-->
<!--        </div>-->
<!--      </div>-->
<!--      @if(!empty($latestHome[0]))-->
<!--      <div class="col__span1">-->
<!--        <a href="{{ route('post.detail',$latestHome[0]->slug) }}" class="news__link" title="news">-->
<!--          <div class="big__img">-->
<!--              @if($latestHome[0]->image)-->
<!--            <figure>-->
<!--              <img src="{{ getImage($latestHome[0]->image) }}" class="w-100" alt="{{ $latestHome[0]->title }}" title="{{ $latestHome[0]->title }}">-->
<!--            </figure>-->
<!--            @endif-->
<!--            <h2 class="news__title--lg">{!! str_limit($latestHome[0]->title,70) !!} </h2>-->
<!--            <p>{!! str_limit(strip_tags($latestHome[0]->description),250) !!}</p>-->
<!--          </div>-->
<!--        </a>-->
<!--      </div>-->
<!--      @endif-->
<!--      <div class="col__span1">-->
<!--        <div class="news__list">-->
<!--          @foreach($latestHome as $kl => $item)-->
<!--          @if($kl > 4)-->
<!--          <div class="news__blockList">-->
<!--            <div class="news__flex news__img--md">-->
<!--                @if($item->image)-->
<!--              <figure>-->
<!--                <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">-->
<!--                  <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title="{{ $item->title }}">-->
<!--                </a>-->
<!--              </figure>-->
<!--              @endif-->
<!--              <div class="news__infos">-->
<!--                <h3 class="news__title--sm"><a href="{{ route('post.detail',$item->slug) }}">{!! str_limit($item->title,52) !!}</a></h3>-->
<!--                <div class="post__time--1">-->
<!--                  <i class="las la-clock"></i> <span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($item->published_date)->diffForHumans()) !!}</span>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--          @endif-->
<!--          @endforeach-->
          
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--    @endif-->
<!--  </div>-->
<!--</section>-->
{{-- <section class="promotional__col section__top ">
  <div class="container">
    <a href="#" title="promotional-img">
      <img src="images/promo.gif" class="w-100" alt="title">
    </a>
  </div>
</section> --}}
<?php $count=1 ?>
@if(count($janamat)>0)
  <section class="janamat_section py-5">
    <div class="container">
        <h1 class="d-flex justify-content-center font-weight-bold" style="font-size:40px">????????????</h1>
        <form action="{{route('save-janamat-answer')}}" method="POST">@csrf
          @foreach($janamat as $index=>$row)
            <div class="pt-4">
              <p class="d-flex justify-content-center text-danger" style="font-size: 30px">{!! strip_tags($row->question) !!}</p>
              <div class="d-flex justify-content-center">
                <div class="d-flex flex-column">
                  @php $ans=explode(',',$row->answers); @endphp
                  @foreach($ans as $key=>$info)
                    <div class="form-check mt-2">
                      <input class="form-check-input" type="radio" name="answer[{{$index}}]" value="option{{$key}}"  style="height: 25px" id="{{$index}}-{{$key}}">
                      <label class="form-check-label ml-4" style="font-size: 20px" for="{{$index}}-{{$key}}">
                        {{$info}}
                      </label>
                    </div>
                  @endforeach
                  <input type="hidden" name="janamat_id[]" value="{{$row->id}}"/>
                </div>
              </div>
            </div>
          @endforeach  
    
          @if(session()->has('error_opinion'))<div class="text-danger error text-center pt-2">* {{session()->get('error_opinion')}}</div>@endif
    
          <div class="pt-4">
            <div class="d-flex justify-content-center">
              <div>
                <input type="text" placeholder="Enter Email Address" name="user_email" class="form-control janamat_email"/>
                  @error('user_email')
                    <div class="text-danger error">{{ $message }}</div>
                  @enderror
              </div> 
            </div>  
            
            <div style="width: 150px" class="mx-auto justify-content-center">
              <button type="submit" class="btn btn-primary px-4 py-2 mt-4"  style="font-size:20px">Submit</button>
            </div>
            
          </div>
      </form>
    </div>
  </section>
@endif 

<!--<div class="container" style="margin-top: 10px">-->
<!--  <div class="row">-->
<!--    <div class="col-md-4 col-lg-3 mt-2">-->
<!--      <img src="{{asset('site/images/dashainads/5.png')}}" class="w-100 ">-->
<!--    </div>-->
<!--    <div class="col-md-4 col-lg-3 mt-2">-->
<!--      <img src="{{asset('site/images/dashainads/6.png')}}" class="w-100 ">-->
<!--    </div>-->
<!--    <div class="col-md-4 col-lg-3 mt-2">-->
<!--      <img src="{{asset('site/images/dashainads/7.png')}}" class="w-100 ">-->
<!--    </div>-->
<!--    <div class="col-md-4 col-lg-3 mt-2">-->
<!--      <img src="{{asset('site/images/dashainads/8.png')}}" class="w-100 ">-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->

{!! getHomeAdvertisement('hp2') !!}
{{-- 
<section class="international__col section__top">
  <div class="container">
    @if(!empty($local_level_elections))
    <div class="title__headFlex">
      <div class="news__title">
        <h2>{{ $local_level_elections->title }} </h2>
      </div>
      <div class="read__more">
        <a href="{{ route('category.list',$local_level_elections->slug) }}" class="btn btn-1">?????????</a>
      </div>
    </div>
    <div class="row">
      <div class="col* col-md-12 col-lg-8">
        <div class="main__news__bar">
          <div class="three__cols--grid">
            @foreach($local_level_elections->list as $kl => $item)
            @if($kl >= 0 && $kl <=5)
            <div class="col__span1">
              <div class="news__md--1">
                   @if($item->image)
                <figure>
                  <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
                    <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title{{ $item->title }}>
                  </a>
                </figure>
                @endif
                <div class="news__infos__md">
                  <h3><a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">{{ str_limit($item->title,100) }}</a></h3>
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
      </div>
      <div class="col* col-md-12 col-lg-4">
        <div class="news__list news__list--flex">
          @foreach($local_level_elections->list as $kl => $item)
          @if($kl >= 6 && $kl <=10)
          <div class="news__blockList">
            <div class="news__flex news__img--md">
                 @if($item->image)
              <figure>
                <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
                  
                  <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title{{ $item->title }}>
                </a>
              </figure>
              @endif
              <div class="news__infos">
                <h3 class="news__title--sm"><a href="{{ route('post.detail',$item->slug) }}">{{ str_limit($item->title,100) }}</a></h3>
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
    </div>
    @endif
  </div>
</section> --}}

<section class="news__col section__top py-5 bg_p_dim">
  <div class="container">
    @if(!empty($news))
    <div class="row">
      <div class="col* col-md-12 col-lg-9">
        <div class="title__headFlex">
          <div class="news__title">
            <h2>{{ $news->title }}</h2>
          </div>
          <div class="read__more">
            <a href="{{ route('category.list',$news->slug) }}" class="btn btn-1">?????????</a>
          </div>
        </div>
        @if(!empty($news->list[0]))
        <div class="single__news">
          <h2 class="news__title--lg">{{ str_limit($news->list[0]->title,100) }}</h2>
          <div class="row">
            <a href="{{ route('post.detail',$news->list[0]->slug) }}" class="news__link" title="news">
              <div class="container">
              <div class="row">
                <div class="col* col-md-1 col-sm-1 col-lg-7">
                  @if($news->list[0]->image)
                  <figure>
                    <img src="{{ getImage($news->list[0]->image) }}" class="w-100" alt="{{ $news->list[0]->title }}" title="{{ $news->list[0]->title }}">
                  </figure>
                  @endif
                </div>
                
                <div class="col* col-md-1 col-sm-1 col-lg-5">
                  <div class="post__time--1 py-3">
                    <i class="las la-clock"></i> <span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($news->list[0]->published_date)->diffForHumans()) !!}</span>
                  </div>
                  <p>
                    {!! str_limit(strip_tags($news->list[0]->description),500) !!}
                  </p>
                </div>
              </div>
              </div>
            </a>
          </div>
        </div>
        @endif
        <div class="btm__news__bar">
          <div class="three__cols--grid">
            @foreach($news->list as $kl => $item)
            @if($kl >= 1 && $kl <=6)
            <div class="col__span1">
              <div class="news__md">
                   @if($item->image)
                <figure>
                  <a href="{{ route('post.detail',$item->slug) }}" title="title">
                    <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title="{{ $item->title }}">
                  </a>
                </figure>
                @endif
                <div class="news__infos__md">
                  <h3>
                  <a href="{{ route('post.detail',$item->slug) }}"> {!! str_limit($item->title,70) !!}</a>
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
      </div>
      <div class="col* col-md-12 d-block d-md-none d-lg-block col-lg-3">
        @include('site.components.homesidebar-ads')
      </div>
    </div>
    @endif
  </div>
</section>

<!--<div class="container" style="margin-top: 10px">-->
<!--  <div class="row">-->
<!--    <div class="col-md-4 col-lg-6 mt-2">-->
<!--      <img src="{{asset('site/images/dashainads/9.png')}}" class="w-100 ">-->
<!--    </div>-->
<!--    <div class="col-md-4 col-lg-6 mt-2">-->
<!--      <img src="{{asset('site/images/dashainads/10.png')}}" class="w-100 ">-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->

<section class="international__col section__top">
  <div class="container">
    @if(!empty($finance))
    <div class="title__headFlex">
      <div class="news__title">
        <h2>{{ $finance->title }} </h2>
      </div>
      <div class="read__more">
        <a href="{{ route('category.list',$finance->slug) }}" class="btn btn-1">?????????</a>
      </div>
    </div>
    <div class="row">
      <div class="col* col-md-12 col-lg-8">
        <div class="main__news__bar">
          <div class="three__cols--grid">
            @foreach($finance->list as $kl => $item)
            @if($kl >= 0 && $kl <=5)
            <div class="col__span1">
              <div class="news__md--1">
                   @if($item->image)
                <figure>
                  <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
                    <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title{{ $item->title }}>
                  </a>
                </figure>
                @endif
                <div class="news__infos__md">
                  <h3><a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">{{ str_limit($item->title,100) }}</a></h3>
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
      </div>
      <div class="col* col-md-12 col-lg-4">
        <div class="news__list news__list--flex">
          @foreach($finance->list as $kl => $item)
          @if($kl >= 6 && $kl <=10)
          <div class="news__blockList">
            <div class="news__flex news__img--md">
                 @if($item->image)
              <figure>
                <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
                  
                  <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title{{ $item->title }}>
                </a>
              </figure>
              @endif
              <div class="news__infos">
                <h3 class="news__title--sm"><a href="{{ route('post.detail',$item->slug) }}">{{ str_limit($item->title,100) }}</a></h3>
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
    </div>
    @endif
  </div>
</section>
{!! getHomeAdvertisement('hp3') !!}
<section class="interview__col section__top py-5 bg_p_dim">
  <div class="container">
    @if(!empty($interview))
    <div class="row">
      <div class="col* col-md-12 col-lg-8">
        <div class="title__headFlex">
          <div class="news__title">
            <h2>{{ $interview->title }} </h2>
          </div>
          
          <div class="read__more">
            <a href="{{ route('category.list',$interview->slug) }}" class="btn btn-1">?????????</a>
          </div>
        </div>
        <div class="top__news__bar news__full1">
          <div class="four__cols--grid grid__gap">
            <div class="col1 col__span3 row__span4">
              @if(!empty($interview->list[0]))
              <div class="single__news text-left">
                <a href="{{ route('post.detail',$interview->list[0]->slug) }}" class="news__link" title="{{ $interview->list[0]->title }}">
                  <div class="big__img">
                       @if($interview->list[0]->image)
                    <figure>
                      <img src="{{ getImage($interview->list[0]->image) }}" class="w-100" alt="{{ $interview->list[0]->title }}" title="{{ $interview->list[0]->title }}">
                    </figure>
                    @endif
                    <h2 class="news__title--lg">{{ str_limit($interview->list[0]->title,100) }}</h2>
                    <p>{!! str_limit(strip_tags($interview->list[0]->description),200) !!}</p>

                  </div>
                </a>
              </div>
              @endif
            </div>
            @if(!empty($interview->list[1]))
            <div class="col__span1">
              <div class="news__md news_border">
                  @if($interview->list[1]->image)
                <figure>
                  <a href="{{ route('post.detail',$interview->list[1]->slug) }}" title="title">
                    <img src="{{ getImage($interview->list[1]->image) }}" class="w-100" alt="{{ $interview->list[1]->title }}" title="{{ $interview->list[1]->title }}">
                  </a>
                </figure>
                @endif
                <div class="news__infos__md">
                  <h3>
                  <a href="{{ route('post.detail',$interview->list[1]->slug) }}"> {{ str_limit($interview->list[1]->title,100) }}</a>
                  </h3>
                  
                </div>
              </div>
            </div>
            @endif
            @foreach($interview->list as $kl => $item)
            @if($kl >= 3 && $kl <=5)
            <div class="col__span1">
              <div class="news__text">
                <a href="{{ route('post.detail',$item->slug) }}">{{ str_limit($item->title,100) }}</a>
              </div>
            </div>
            @endif
            @endforeach
          </div>
        </div>
      </div>
      <div class="col* col-md-12 col-lg-4">
        @include('site.components.trending')
      </div>
    </div>
    @endif
  </div>
</section>
{!! getHomeAdvertisement('hp4') !!}
<section class="international__col section__top">
  <div class="container">
    @if(!empty($international))
    <div class="title__headFlex">
      <div class="news__title">
        <h2>{{ $international->title }} </h2>
      </div>
      <div class="read__more">
        <a href="{{ route('category.list',$international->slug) }}" class="btn btn-1">?????????</a>
      </div>
    </div>
    <div class="row">
      <div class="col* col-md-12 col-lg-8">
        <div class="main__news__bar">
          <div class="three__cols--grid">
            @foreach($international->list as $kl => $item)
            @if($kl >= 0 && $kl <=5)
            <div class="col__span1">
              <div class="news__md--1">
                  @if($item->image)
                <figure>
                  <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
                    <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title{{ $item->title }}>
                  </a>
                </figure>
                @endif
                <div class="news__infos__md">
                  <h3><a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">{{ str_limit($item->title,100) }}</a></h3>
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
      </div>
      <div class="col* col-md-12 col-lg-4">
        <div class="news__list news__list--flex">
          @foreach($international->list as $kl => $item)
          @if($kl >= 6 && $kl <=10)
          <div class="news__blockList">
            <div class="news__flex news__img--md">
                @if($item->image)
              <figure>
                <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
                  
                  <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title{{ $item->title }}>
                </a>
              </figure>
              @endif
              <div class="news__infos">
                <h3 class="news__title--sm"><a href="{{ route('post.detail',$item->slug) }}">{{ str_limit($item->title,100) }}</a></h3>
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
    </div>
    @endif
  </div>
</section>
{!! getHomeAdvertisement('hp5') !!}
<section class="entertainment__col section__top py-5 bg_p_dim">
  <div class="container">
    @if(!empty($entertainment))
    <div class="title__headFlex">
      <div class="news__title">
        <h2>{{ $entertainment->title }}</h2>
      </div>
      <div class="read__more">
        <a href="{{ route('category.list',$entertainment->slug) }}" class="btn btn-1">?????????</a>
      </div>
    </div>
    <div class="news__img--single commonGutters">
      <div class="row no-gutters">
        <div class="col* col-md-7 col-lg-6 single--img">
          @if(!empty($entertainment->list[0]))
          <div class="featureImg bigImg">
            <div class="mainBigImg featureBgImg itemAfter" 
            @if($entertainment->list[0]->image)
            style="background: url({{ getImage($entertainment->list[0]->image) }});background-size: cover;background-repeat: no-repeat;background-position: center;"
            @endif
            >
              <div class="featureOverlay"></div>
              <div class="featureBgInfos">
                <h2><a href="{{ route('post.detail',$entertainment->list[0]->slug) }}" class="postTitle">{{ str_limit($entertainment->list[0]->title,100) }}</a></h2>
                <p>{!! str_limit(strip_tags($entertainment->list[0]->description),200) !!}</p>

              </div>
            </div>
          </div>
          @endif
        </div>
        <div class="col* col-md-5 col-lg-6 single--img1">
          @if(!empty($entertainment->list[1]))
          <div class="featureImg smallImg">
            <div class="mainBigImg featureBgImg itemAfter"
            @if($entertainment->list[1]->image)
            style="background: url({{ getImage($entertainment->list[1]->image) }});background-size: cover;background-repeat: no-repeat;background-position: center;"
            @endif
            >
              <div class="featureOverlay"></div>
              
              <div class="featureBgInfos">
                <h3><a href="{{ route('post.detail',$entertainment->list[1]->slug) }}" class="postTitle">{{ str_limit($entertainment->list[1]->title,100) }}</a></h3>
                    <p>{!! str_limit(strip_tags($entertainment->list[1]->description),200) !!}</p>

              </div>
            </div>
          </div>
          @endif
          <div class="ftImgBtm">
            <div class="row no-gutters">
              @foreach($entertainment->list as $kl => $item)
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
    @endif
  </div>
</section>
<section class="literture__col section__top">
  <div class="container">
    
    @if(!empty($literature))
    <div class="row">
      <div class="col* col-md-12 col-lg-8">
        <div class="title__headFlex">
          <div class="news__title">
            <h2>{{ $literature->title }} </h2>
          </div>
          
          <div class="read__more">
            <a href="{{ route('category.list',$literature->slug) }}" class="btn btn-1">?????????</a>
          </div>
        </div>
        <div class="four__cols--grid">
          @if(!empty($literature->list[0]))
          <div class="col__span2">
            <div class="featureImg bigImg">
              <div class="mainBigImg featureBgImg itemAfter" 
              @if($literature->list[0]->image)
              style="background: url({{ getImage($literature->list[0]->image) }});background-size: cover;background-repeat: no-repeat;background-position: center;"
              @endif
              >
                <div class="featureOverlay"></div>
                
                <div class="featureBgInfos">
                  <h3><a href="{{ route('post.detail',$literature->list[0]->slug) }}">{{ str_limit($literature->list[0]->title,100) }}</a></h3>
                  <p>{!! str_limit(strip_tags($literature->list[0]->description),200) !!}</p>
                </div>
                
              </div>
            </div>
          </div>
          @endif
          <div class="col__span2">
            <div class="news__list">
              @foreach($literature->list as $kl => $item)
              @if($kl >= 1 && $kl <=5)
              <div class="news__blockList">
                <div class="news__flex news__img--md">
                  <figure>
                    <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
                      <img src="{{ getImage($item->image) }}" class="w-100 h-100" alt="{{ $item->title }}" title{{ $item->title }}>
                    </a>
                  </figure>
                  
                  <div class="news__infos">
                    <h3 class="news__title--sm"><a href="{{ route('post.detail',$item->slug) }}">{!! str_limit($item->title,70) !!}</a></h3>
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
        </div>
      </div>
      <div class="col* col-md-12 col-lg-4">
        @if(!empty($opinion))
        <div class="title__headFlex">
      <div class="news__title">
        <h2>{{ $opinion->title }} </h2>
      </div>
      <div class="read__more">
        <a href="{{ route('category.list',$opinion->slug) }}" class="btn btn-1">?????????</a>
      </div>
    </div>
        <div class="trending__box thought__list">
          <ul class="list-unstyled">
            @foreach($opinion->list as $item)
            <li>
              <div class="media">
                  @if($item->image)
                <figure class="avatar mr-2">
                  <img src="{{ getImage($item->image) }}" class="rounded-circle w-100" alt="{{ $item->title }}" title{{ $item->title }}>
                </figure>
                @endif
                <div class="media__latest--infos">
                  <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">{{ str_limit($item->title,100) }}</a>
                  <small class="d-block font-weight-bold text-primary">{{ authorName($item->author_name,$item->author_id) }}</small>
                </div>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
    </div>
    @endif
  </div>
</section>
{!! getHomeAdvertisement('hp6') !!}
<section class="technology__col section__top py-5 bg_p_dim">
  <div class="container">
    @if(!empty($technology))
    <div class="title__headFlex">
      <div class="news__title">
        <h2>{{ $technology->title }} </h2>
      </div>
      <div class="read__more">
        <a href="{{ route('category.list',$technology->slug) }}" class="btn btn-1">?????????</a>
      </div>
    </div>
    <div class="row no-gutters">
      @foreach($technology->list as $kl => $item)
      @if($kl >= 0 && $kl <=1)
      <div class="col* col-md-6 col-lg-6 single_img-2">
        <div class="single__news">
          <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}" class="news__link">
            <div class="big__img">
                @if($item->image)
              <figure>
                <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title="{{ $item->title }}">
              </figure>
              @endif
              <h2 class="news__title--lg"> {!! str_limit($item->title,45) !!}</h2>
                  <p>{!! str_limit(strip_tags($item->description),200) !!}</p>
            </div>
          </a>
        </div>
      </div>
      @endif
      @endforeach
    </div>
    <div class="btm__news__bar--1">
      <div class="four__cols--grid">
        @foreach($technology->list as $kl => $item)
        @if($kl >1)
        <div class="col__span1">
          <div class="news__md">
              @if($item->image)
            <figure>
              <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
                <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title="{{ $item->title }}">
              </a>
            </figure>
            @endif
            
            <div class="news__infos__md">
              <h3>
              <a href="{{ route('post.detail',$item->slug) }}">{!! str_limit($item->title,70) !!}</a>
              </h3>
              
            </div>
          </div>
        </div>
        @endif
        @endforeach
        
      </div>
    </div>
    @endif
  </div>
</section>
<section class="sports__col section__top">
  <div class="container">
    @if(!empty($sports))
    <div class="title__headFlex">
      <div class="news__title">
        <h2>{{ $sports->title }} </h2>
      </div>
      <div class="read__more">
        <a href="{{ route('category.list',$sports->slug) }}" class="btn btn-1">?????????</a>
      </div>
    </div>
    <div class="news__img--single commonGutters">
      <div class="row no-gutters">
        <div class="col* col-md-6 col-lg-6 single--img3">
          <div class="ftImgBtm">
            <div class="row no-gutters">
              @foreach($sports->list as $kl => $item)
              @if($kl >= 1 && $kl <=4)
              <div class="col* col-md-6 col-lg-6 smallNewsFeature">
                <div class="featureImg smallImg">
                  <div class="mainBigImg featureBgImg itemAfter" 
                  @if($item->image)
                  style="background: url({{ getImage($item->image) }});background-size: cover;background-repeat: no-repeat;background-position: center;"
                  @endif
                  >
                    <div class="featureOverlay"></div>
                    
                    <div class="featureBgInfos">
                      <h3><a href="{{ route('post.detail',$item->slug) }}" class="postTitle"> {{ str_limit($item->title,100) }}</a></h3>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              @endforeach
              
            </div>
          </div>
          
        </div>
        <div class="col* col-md-6 col-lg-6 single--img">
          @if(!empty($sports->list[0]))
          <div class="featureImg bigImg">
            <div class="mainBigImg featureBgImg itemAfter" 
             @if($sports->list[0]->image)
             style="background: url({{ getImage($sports->list[0]->image) }});background-size: cover;background-repeat: no-repeat;background-position: center;"
             @endif
             >
              <div class="featureOverlay"></div>
              <div class="featureBgInfos">
                <h2><a href="{{ route('post.detail',$sports->list[0]->slug) }}" class="postTitle">{{ str_limit($sports->list[0]->title,100) }}</a></h2>
                  <p>{!! str_limit(strip_tags($sports->list[0]->description),150) !!}</p>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
    @endif
  </div>
</section>
<section class="lifestyle__col section__top py-5 bg_p_dim">
  <div class="container">
    @if(!empty($lifestyle))
    <div class="title__headFlex">
      <div class="news__title">
        <h2> {{ $lifestyle->title }} </h2>
      </div>
      <div class="read__more">
        <a href="{{ route('category.list',$lifestyle->slug) }}" class="btn btn-1">?????????</a>
      </div>
    </div>
    @if(count($lifestyle->list)>0)
    <div class="row">
      <div class="col* col-md-12 col-lg-12">
        <div class="main__news__bar">
          <div class="four__cols--grid">
            @foreach($lifestyle->list as $kl => $item)
            <div class="col__span1">
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
                  <a href="{{ route('post.detail',$item->slug) }}"> {!! str_limit($item->title,70) !!}</a>
                  </h3>
                  <div class="post__time--1">
                    <i class="las la-clock"></i> <span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($item->published_date)->diffForHumans()) !!}</span>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @endif
    @endif
  </div>
</section>
<!--<section class="lifestyle__col section__top">-->
<!--  <div class="container">-->
<!--    @if(!empty($albums))-->
<!--    <div class="title__headFlex">-->
<!--      <div class="news__title">-->
<!--        <h2> ???????????? ???????????????????????? </h2>-->
<!--      </div>-->
<!--      <div class="read__more">-->
<!--        <a href="{{ route('album') }}" class="btn btn-1">?????????</a>-->
<!--      </div>-->
<!--    </div>-->
<!--    @if(count($albums)>0)-->
<!--    <div class="row">-->
<!--      <div class="col* col-md-12 col-lg-12">-->
<!--        <div class="main__news__bar">-->
<!--          <div class="four__cols--grid">-->
<!--            @foreach($albums as $kl => $item)-->
<!--            <div class="col__span1">-->
<!--              <div class="news__md--1">-->
<!--                  @if($item->image)-->
<!--                <figure>-->
<!--                  <a href="{{ route('albumSingle',$item->slug) }}" title="{{ $item->title }}">-->
<!--                    <img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title="{{ $item->title }}">-->
<!--                  </a>-->
<!--                </figure>-->
<!--                @endif-->
<!--                <div class="news__infos__md">-->
<!--                  <h3>-->
<!--                  <a href="{{ route('albumSingle',$item->slug) }}"> {!! str_limit($item->title,70) !!}</a>-->
<!--                  </h3>-->
<!--                  <div class="post__time--1">-->
<!--                    <i class="las la-clock"></i> <span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($item->created_at)->diffForHumans()) !!}</span>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--            @endforeach-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--    @endif-->
<!--    @endif-->
<!--  </div>-->
<!--</section>-->

<section id="banner" style="background-color: #04EAF2">
  <div class="container">
      <img src="{{asset('site/images/banners/farwest_times.png')}}" height="100%" width="100%"/>
  </div>
</section> 
{{-- axds --}}

{!! getHomeAdvertisement('hp13') !!}

<script>
  $(function(){
        $('#roadblockModal').modal('show');
        $('.modal-backdrop.fade.in').css({
            'opacity':'0.9',
            'background':"#626262"
        });
        setTimeout(function(){
            $('#roadblockModal').modal('hide');
         },5000);
    });
</script>
@endsection