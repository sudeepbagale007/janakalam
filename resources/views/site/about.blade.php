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
					@include('site.components.pagedetail-sub-head-ads')
					<div class="single__detail">
                 <p>नेपालको सिमानाभित्र बसोबास गर्ने र संसारभर आफूलाई नेपाली भनेर चिनाउने नेपाली मन र नेपालीपनको सुवासको सुरक्षा गर्नुलाई हामी आफ्नो महत्वपूर्ण कर्तव्य ठान्छौं । देश र विदेशमा रहेका नेपाली र नेपालका शुभचिन्तकलाई नेपाल र विश्वमा भएका घटनाक्रमको ताजा जानकारी दिलाउनु र समाजमा सकारात्मक परिवर्तनका लागि विचार र विवेचनाको संवाहक हुने जिम्मेवारी बाह्रखरीले लिएको छ ।</p>
                 <p>जनताको जीवनको अधिकार, सम्पत्तिको अधिकार, विचार र अभिव्यक्ति स्वतन्त्रताकोअधिकार रक्षाका मूल्यमा कुनै पनि शक्तिसँग कहिल्यै सम्झौता नगर्ने प्रतिबद्धताका साथ जनसञ्चारको आधुनिक माध्यम अनलाइन पत्रकारितामार्फत् बाह्रखरीले सशक्त उपस्थिती जनाएको छ ।</p>
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
