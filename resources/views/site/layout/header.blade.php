<header style="border-top: 2px solid #012c71;" >
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                   <div class="socialwrapper">
                       <ul class="socialIcons">
                           <li class="icon">
                               <a href="#" target="_blank">
                                   
                               
                               <i class="lab la-facebook-f"></i>
                               
                               </a>
                           </li>
                            <li class="icon">
                               <i class="lab la-twitter"></i>
                           </li>
                            <li class="icon">
                               <i class="lab la-linkedin"></i>
                           </li>
                            <li class="icon">
                               <i class="lab la-instagram"></i>
                           </li>
                       </ul>
                   </div>
                </div>
                <div class='col-sm-10 d-flex align-items-center'>
                    <div class="marquewrapper">
                        <marquee>
                            <ul style="list-style:none; display:flex; gap: 15px;">
                                <li>
                                    <a href="#" class="text-muted">
                                      अफगानिस्तानमा रहेका नेपालीको उद्धारको तयारी, दिल्लीस्थित नेपाली दूतावासद्धारा घर..
                                        
                                    </a>
                                </li><li>
                                    <a href="#" class="text-muted">
                                      बस र ट्रक आपसमा ठोक्किँदा एक जनाको मृत्यु, १२ घाइते
                                        
                                    </a>
                                </li><li>
                                    <a href="#" class="text-muted">
                                       
बाबु बितेर बिचल्लीमा परेका ३ जनालाई सेभ हाउसले पढाउने
                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-muted">
	बाजुराको छुद्दरी गाउँमा गयो सुक्खा पहिरो, कर्णाली नदी थुनिने खतरा
                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-muted">
                                     	अफगानिस्तानबाट नेपालीको उद्धारका लागि सरकार गम्भीर छ : प्रधानमन्त्री देउवा	
                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-muted">
                                     	सोमबार राति १२ बजेदेखि संसद अधिवेशन अन्त्य गर्न सिफारिस
                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-muted">
                                       	रंगमञ्चको दुनियाँमा “हाँसो” कलाका बादशाह : मदनदास श्रेष्ठ (भिडियो समाचार)
                                        
                                    </a>
                                </li><li>
                                    <a href="#" class="text-muted">
                                        अव तालिबानका कुन नेता बन्लान् अफगानिस्तानको नयाँ राष्ट्रपति ?
                                        
                                    </a>
                                </li>
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
        <div class="col* col-sm-5 col-md-3 col-lg-3 logo__left">
          <a href="{{ route('index') }}" title="{{ $sitedetail->title_en }}">
            <img src="{{ asset($sitedetail->logo) }}" alt="{{ $sitedetail->title_en }}" title="{{ $sitedetail->title_en }}" class="img-fluid">
          </a>
          <div class="header__date">
            <span>{!! getTodayNepaliDate() !!} </span>
          </div>
        </div>
        <div class="col* col-sm-1 col-md-1 col-lg-1 logo__right">
          <img src="{{asset('site/images/23-years-exce.gif')}}" style="max-height: 60px">
        </div>
        <div class="col* col-sm-6 col-md-8 col-lg-8 logo__right">
          @if(!empty($advertisement['topheaderad_1']))
          <a href="{{ $advertisement['topheaderad_1']->url }}" title="{{ $advertisement['topheaderad_1']->title }}" target="_blank">
            <img src="{{ asset($advertisement['topheaderad_1']->image) }}" alt="{{ $advertisement['topheaderad_1']->title }}" class="img-fluid">
          </a>
          @endif
        </div>
        
      </div>
    </div>
  </div>
  <div id="sticky" class="menu__header" style="background:#061E9B">    
    <div class="xs-navBar" style="display: flex; align-items: center;">
        <div class="sticky_logo px-3" style=''>
            <img src="{{ asset($sitedetail->logo) }}" alt="{{ $sitedetail->title_en }}" style="max-height: 50px" title="{{ $sitedetail->title_en }}" class="img-fluid">
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