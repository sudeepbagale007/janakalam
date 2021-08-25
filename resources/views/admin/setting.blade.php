@extends('admin.app')
@section('content')
<h2>{{ $page_header }}</h2>
<form class="" method="POST" action="{{ route('update.setting') }}">
    {{ csrf_field() }}
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Basic Information</a></li>
            <li><a href="#tab_2" data-toggle="tab" aria-expanded="false">Social</a></li>
            <li><a href="#tab_3" data-toggle="tab" aria-expanded="true">Meta Tags</a></li>
            <li><a href="#tab_4" data-toggle="tab" aria-expanded="true">Info</a></li>
            <li><a href="#tab_5" data-toggle="tab" aria-expanded="true">Others</a></li>
            <li class="pull-right"><button type="submit" class="btn btn-success"><i class="fa fa-bookmark" aria-hidden="true"></i> Submit</button></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="title_en">Title</label>
                            <input type="text" class="form-control" id="title_en" name="title_en" value="{{ $settingdata->title_en }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $settingdata->email }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="address_en">Address</label>
                            <input type="text" class="form-control" id="address_en" name="address_en" value="{{ $settingdata->address_en }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="mobile_no">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ $settingdata->mobile_no }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="phone_no">Phone Number</label>
                            <input type="text" class="form-control" id="phone_no" name="phone_no" value="{{ $settingdata->phone_no }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="fax_no">Fax Number</label>
                            <input type="text" class="form-control" id="fax_no" name="fax_no" value="{{ $settingdata->fax_no }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="post_box_no">Post Box Number</label>
                            <input type="text" class="form-control" id="post_box_no" name="post_box_no" value="{{ $settingdata->post_box_no }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="office_hour">Office Hour</label>
                            <input type="text" class="form-control" id="office_hour" name="office_hour" value="{{ $settingdata->office_hour }}" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            @if(!empty($settingdata->logo))
                            <img src="<?php echo $settingdata->logo ?>" class="fancybox" id="prev_img" />
                            @else
                            <img src="{{ asset('admin/images/no-image.png', $secure = null) }}" class="fancybox" id="prev_img" />
                            @endif
                            <a href="{{ url('/uploads/filemanager/dialog.php?type=1&field_id=logo') }}" data-fancybox-type="iframe" class="btn btn-info fancy">Insert</a>
                            <button class="btn btn-danger remove_box_image" type="button">Remove</button>
                            <input type="hidden" value="{{ $settingdata->logo ?? '' }}"  name="logo" class="form-control" id="logo">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dark_logo">Dark Logo</label>
                            @if(!empty($settingdata->dark_logo))
                            <img src="<?php echo $settingdata->dark_logo ?>" class="fancybox" id="prev_dark_logo_img" />
                            @else
                            <img src="{{ asset('admin/images/no-image.png', $secure = null) }}" class="fancybox" id="prev_dark_logo_img" />
                            @endif
                            <a href="{{ url('/uploads/filemanager/dialog.php?type=1&field_id=dark_logo') }}" data-fancybox-type="iframe" class="btn btn-info fancy">Insert</a>
                            <button class="btn btn-danger remove_dark_logo_img" type="button">Remove</button>
                            <input type="hidden" value="{{ $settingdata->dark_logo ?? '' }}"  name="dark_logo" class="form-control" id="dark_logo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="map">Map Area</label>
                            <textarea class="form-control" id="map" rows="8" cols="2" name="map">{{ $settingdata->map }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="facebook">Facebook</label>
                            <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $settingdata->facebook }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="twitter">Twitter</label>
                            <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $settingdata->twitter }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="skype">Skype</label>
                            <input type="text" class="form-control" id="skype" name="skype" value="{{ $settingdata->skype }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="linkedin">Linkedin</label>
                            <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ $settingdata->linkedin }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="youtube">YouTube</label>
                            <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $settingdata->youtube }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="instagram">Instagram</label>
                            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $settingdata->instagram }}" >
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fb_image">Facebook Image</label>
                            @if(!empty($settingdata->fb_image))
                            <img src="<?php echo $settingdata->fb_image ?>" class="fancybox" id="prev_fb_image_img" />
                            @else
                            <img src="{{ asset('admin/images/no-image.png', $secure = null) }}" class="fancybox" id="prev_fb_image_img" />
                            @endif
                            <a href="{{ url('/uploads/filemanager/dialog.php?type=1&field_id=fb_image') }}" data-fancybox-type="iframe" class="btn btn-info fancy">Insert</a>
                            <button class="btn btn-danger remove_fb_image_img" type="button">Remove</button>
                            <input type="hidden" value="{{ $settingdata->fb_image ?? '' }}"  name="fb_image" class="form-control" id="fb_image">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                <div class="form-group">
                    <label class="control-label" for="meta_keywords">Meta Keywords</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $settingdata->meta_keywords }}" >
                </div>
                <div class="form-group">
                    <label class="control-label" for="meta_descriptions">Meta Descriptions</label>
                    <textarea class="form-control" id="meta_descriptions" rows="10" cols="20" name="meta_descriptions">{{ $settingdata->meta_descriptions }}</textarea>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_4">
                <div class="form-group">
                    <label class="control-label" for="company_name">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $settingdata->company_name }}" >
                </div>
                <div class="form-group">
                    <label class="control-label" for="publisher_name">Publisher Name</label>
                    <input type="text" class="form-control" id="publisher_name" name="publisher_name" value="{{ $settingdata->publisher_name }}" >
                </div>
                <div class="form-group">
                    <label class="control-label" for="post_owner">Post Owner Name</label>
                    <input type="text" class="form-control" id="post_owner" name="post_owner" value="{{ $settingdata->post_owner }}" >
                </div>
                <div class="form-group">
                    <label class="control-label" for="moderator_name">Moderator Name</label>
                    <input type="text" class="form-control" id="moderator_name" name="moderator_name" value="{{ $settingdata->moderator_name }}" >
                </div>
                <div class="form-group">
                    <label class="control-label" for="editor_name">Editor Name</label>
                    <input type="text" class="form-control" id="editor_name" name="editor_name" value="{{ $settingdata->editor_name }}" >
                </div>
                <div class="form-group">
                    <label class="control-label" for="regd_no">Regd Number</label>
                    <input type="text" class="form-control" id="regd_no" name="regd_no" value="{{ $settingdata->regd_no }}" >
                </div>
                <div class="form-group">
                    <label class="control-label" for="short_description">Short Description</label>
                    <input type="text" class="form-control" id="short_description" name="short_description" value="{{ $settingdata->short_description }}" >
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="breaking_news_count">Total Breaking News Show</label>
                            <input type="number" class="form-control" id="breaking_news_count" name="breaking_news_count" value="{{ $settingdata->breaking_news_count }}" max="8" min="1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.tab-content -->
    </div>
</form>
@endsection