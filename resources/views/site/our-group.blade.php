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
					<div class="detail__post__infos">
						<h2 class="detail__post__title">हाम्रो-समूह</h2>
					</div>
					<div class="single__detail">
						<div class="textwidget custom-html-widget">
						<p>यो साइट विगत २३ वर्षदेखी प्रकाशन हुँदै आएको फारवेष्ट टाईम्स नेपाली राष्ट्रिय दैनिकको आधिकारिक न्यूज पोर्टल हो www.farwesttimesdaily.com विश्वभर छरिएका नेपालीलाई समसामयिक विषयमा राष्ट्रिय अन्तरराष्ट्रिय घटनाको जानकारी गराउनु हाम्रो उद्देश्य हो। सातै प्रदेशका समाचारलाई प्रमुख महत्व दिई निष्पक्ष र स्वतन्त्र समाचार दिनु हाम्रो मुख्य लक्ष्य हो ।</p>
						<p>यो पोर्टलमा समाचार, विचार, विश्लेषण, फिचर स्टोरी, बजार, मनोरञ्जन, खेलकूद, अन्तरराष्ट्रिय घटनाक्रम, प्रविधि, भिडियो दृष्यका साथै सामाजिक घटनालाई समावेश गर्ने प्रयास गर्नेछौ । यसलाई थप पठनीय एवं स्तरीय बनाउन पाठकवर्गको सहयोग र सुझाव अपेक्षा गर्दछौ ।</p>
						<strong>फारवेष्ट टाईम्स नेपाली दैनिक</strong><br />
						भीमदत्त नगरपालिका–६, कञ्चनपुर, जि.प्र.का दर्ता नं १८ ⁄ ०५५ ⁄ ०५६
						</div>
						<div><strong>प्रकाशक तथा सम्पादक</strong><br />
						कर्ण देव भट्ट</p>
						</div>
						<div><strong>Farwesttimesdaily.com</strong></p></div>
						<div class="row">
						<div class="col-md-6"><strong>संचालक</strong><br />
						कर्णदेव भट्ट
						</div>
						<div class="col-md-6"><strong>प्रधान सम्पादक</strong><br />
						सुधीर नेपाल
						</div>
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
