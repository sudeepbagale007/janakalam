<header style="border-top: 2px solid #0e5dae;" >
  <div class="topbar">
      <div class="container">
          <div class="row">
              <div class='col-sm-10 d-flex align-items-center'>
                  <div class="marquewrapper d-flex" style="gap: 10px">
                      <span>Highlights: </span>
                      <marquee scrollamount='5' onmouseover="this.stop();" onmouseout="this.start();">
                          <ul style="list-style:none; display:flex; gap: 15px;">
                              @foreach($latest as $item)
                              <li class="d-flex flex-row">
                                  <a href="{{ route('post.detail',$item->slug) }}" class="text-muted" style="color: red !important;">
                                    {{$item->title}}</a>
                                  <span class="px-2 text-muted">|</span>  
                              </li>
                              @endforeach
                          </ul>
                      </marquee>
                  </div>
              </div>
          </div>
      </div>
  </div>
<div class="logo__header">
  <div class="container">
    <div class="row">
      <div class="d-flex flex-row col-sm-6 col-md-6 col-lg-4">  
          <div class="">
            <a href="{{ route('index') }}" title="{{ $sitedetail->title_en }}">
              <img src="{{ asset($sitedetail->logo) }}" alt="{{ $sitedetail->title_en }}" style="height: 90px" title="{{ $sitedetail->title_en }}" class="img-fluid">
            </a>
          </div>
           <div class="py-4">
            <img src="{{asset('site/images/23-years-exce.gif')}}" style="max-height: 60px">
          </div>
      </div>
      <div class="col* col-sm-6 col-md-6 col-lg-8 logo__right">
        @if(!empty($advertisement['topheaderad_1']))
        <a href="{{ $advertisement['topheaderad_1']->url }}" title="{{ $advertisement['topheaderad_1']->title }}" target="_blank">
          <img src="{{ asset($advertisement['topheaderad_1']->image) }}" alt="{{ $advertisement['topheaderad_1']->title }}" class="img-fluid">
        </a>
        @endif
      </div>
    </div>
    <div class="my-4 mx-4">
      <span>{!! getTodayNepaliDate() !!}</span>
      <span id="clock" onload="currentTime()"></span>
    </div>
  </div>
</div>
<div id="sticky" class="menu__header" style="background:#061E9B">
      
  <div class="xs-navBar" style="display: flex; align-items: center;">
      <div class="sticky_logo px-3" style=''>
          <img src="{{ asset($sitedetail->dark_logo) }}" alt="{{ $sitedetail->title_en }}" style="max-height: 40px" title="{{ $sitedetail->title_en }}" class="img-fluid">
    </div>
    <div class="container">
      <nav class="xs-menus">
        <div class="nav-header">
          <div class="nav-toggle"></div>
        </div>
        <div class="nav-menus-wrapper">
          <ul class="nav-menu">
            <?php $url = Request::url(); ?>
            @if(!empty($menulist['primarymenu']))
            @foreach($menulist['primarymenu'] as $kl => $item)
            @if(!empty($item['child']))
            <li {{ ($url == $item['link'])?'class=active':'' }}>
              <a href="{{ $item['link'] }}" @if($item['newtab'] == '1') {{ 'target="_blank"' }} @endif>{{ $item['label'] }}</a>
              <ul class="nav-dropdown">
                @foreach($item['child'] as $kl => $onelevel)
                <li> <a class="dropdown-item" href="{{ $onelevel['link'] }}" @if($onelevel['newtab'] == '1') {{ 'target="_blank"' }} @endif>{{ $onelevel['label'] }}</a></li>
                @endforeach
              </ul>
            </li>
            @else
            <li {{ ($url == $item['link'])?'class=active':'' }}><a href="{{ $item['link'] }}" @if($item['newtab'] == '1') {{ 'target="_blank"' }} @endif>{{ $item['label'] }}</a></li>
            @endif
            @endforeach
            @endif
            <div class="clearfix"></div>
          </ul>
        </div>
        <div class="header__right">
          <div class="header__rightFlex">
            <form action="{{ route('search') }}" id="searchForm"  method="post">
              {{ csrf_field() }}
              <div class="searchbar">
                <input class="search_input" type="text" name="search" placeholder="Search Keyword..." value="{{ isset($_POST['search'])?$_POST['search']:'' }}" required>
                <!--<a href="{{ route('search') }}" class="search_icon"><i class="las la-search"></i></a>-->
                <a class="search_icon" style="cursor: pointer;" href="javascript: submitform()"><i class="las la-search"></i></a>
              </div>
            </form>
            <div class="header__newsLatest">
              <a href="javascript:void(0)" class="filterToggle">
                <i class="las la-clock"></i>
              </a>
            </div>
            <div class="videoBar">
              <a href="{{ route('video') }}">
                <i class="lab la-youtube"></i>
              </a>
            </div>
             <div class="facbookBar" >
              <a  href="https://www.facebook.com/Farwest-Times-Daily-News-103938428145090">
                <i class="fab fa-facebook-square"></i>
              </a>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <div class="filterInfos" style="display: none;">
      @if(!empty($latest))
      <div class="container">
        <h2>ताजा अपडेट</h2>
        <div class="news__latest__header">
          <div class="row">
            @foreach($latest as $item)
            <div class="col* col-md-4 col-lg-4 news__latest--list">
              <div class="news__blockList">
                <div class="news__flex news__img--md">
                  <figure>
                    <a href="{{ route('post.detail',$item->slug) }}" title="{{ $item->title }}">
                      <img src="{{ getImage($item->image) }}" class="w-100 h-100" alt="{{ $item->title }}" title="{{ $item->title }}">
                    </a>
                  </figure>
                  
                  <div class="news__infos">
                    <h3 class="news__title--sm"><a href="{{ route('post.detail',$item->slug) }}"> {!! str_limit($item->title,70) !!}</a></h3>
                    <div class="post__time--1">
                      <i class="las la-clock"></i> <span>{!! changeEngHumanDateToNepali(Carbon\Carbon::parse($item->published_date)->diffForHumans()) !!}</span>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
</header>

<script>
  function currentTime() {
    let date1 = new Date().toLocaleString("en-US", {timeZone: "Asia/Kathmandu"});
    let date=new Date(date1);
    let hh = date.getHours();
    let mm = date.getMinutes();
    let ss = date.getSeconds();
    let session = "AM";

    if(hh === 0){
        hh = 12;
    }
    if(hh > 12){
        hh = hh - 12;
        session = "PM";
    }

    hh = (hh < 10) ? "0" + hh : hh;
    mm = (mm < 10) ? "0" + mm : mm;
    ss = (ss < 10) ? "0" + ss : ss;    
    let time = hh + ":" + mm + ":" + ss + " " + session;
    document.getElementById("clock").innerText = time; 
    let t = setTimeout(function(){ currentTime() }, 1000);
  }

  currentTime();
</script>