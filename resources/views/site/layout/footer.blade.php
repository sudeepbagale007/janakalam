<footer class="ftco-footer bg-bottom ftco-no-pt" style="background-color: rgb(6, 30, 155);  ;">
  <div class="container">
      <div class="row mb-1">
          <div class="col-md ">
              <div class="ftco-footer-widget pt-5 mb-4">
                <img src="{{ asset($sitedetail->dark_logo) }}" style="max-width: 250px" alt="{{ $sitedetail->title_en }}" title="{{ $sitedetail->title_en }}" class="img-fluid">
              </div>
          </div>
              <div class="col-md  border-left">
                  <div class="ftco-footer-widget pt-md-5 mb-4 ml-md-5">
                      <h2 class="ftco-heading-2">प्रकाशक तथा सम्पादक:</h2>
                      <ul>
                          <li>कर्ण देव भट्ट</li>
                      </ul>
                  </div>
              </div>
              <div class="col-md  border-left">
                  <div class="ftco-footer-widget pt-md-5 mb-4">
                      <h2 class="ftco-heading-2">संचालक:</h2>
                      <ul>
                          <li>कर्णदेव भट्ट</li>
                      </ul>
                  </div>
              </div>
              <div class="col-md  border-left">
                  <div class="ftco-footer-widget pt-md-5 mb-4">
                      <h2 class="ftco-heading-2">फारवेष्ट टाईम्स नेपाली दैनिक</h2>
                      <div class="block-23 mb-3">
                          <ul>
                              <li><span class="text">भीमदत्त नगरपालिका–६ कञ्चनपुर,  जि.प्र.का </span></li>
                              <li><span class="text">दर्ता नं: १८ ⁄०५५ ⁄ ०५६</span></li>
                          </ul>
                      </div>
                  </div>
              </div>
      </div>
      <div class="row ftco-no-pb">
            <div class="col-md">
                <div class="py-4">
                    <a href="{{route('about')}}"> हाम्रोबारे </a>
                    <a href="{{route('about-group')}}"> हाम्रो-समूह </a>
                </div>
            </div>
            <div class="col-md">
                <p class="py-4">
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> farwesttimesdaily.com सर्वाधिकार सुरक्षित
                </p>
            </div>
            <div class="col-md text-lg-right">
                <p class="py-4">
                    सूचना विभाग दर्ता नंः २२७५/०७७/०७८
                </p>
            </div>
        </div>
      </div>
  </footer>
<a href="#" class="btn-scroll-top">
  <i class="las la-angle-up"></i>
</a>
<input type="hidden" name="baseurl" id="baseurl" value="{{ url('/') }}">