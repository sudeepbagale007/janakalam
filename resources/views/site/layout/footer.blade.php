<footer>
  <div class="main__footer">
    <div class="container">
      <div class="row">
        <div class="col* col-sm-6 col-md-4 col-lg-4 footer__menu">
          <div class="company__infos">
            <figure>
              <a href="{{ route('index') }}">
                <img src="{{ asset($sitedetail->dark_logo) }}" alt="{{ $sitedetail->title_en }}" title="{{ $sitedetail->title_en }}" class="img-fluid">
              </a>
            </figure>
        
        </div>
      </div>
     
    </div>
  </div>
</footer>
<a href="#" class="btn-scroll-top">
  <i class="las la-angle-up"></i>
</a>
<input type="hidden" name="baseurl" id="baseurl" value="{{ url('/') }}">