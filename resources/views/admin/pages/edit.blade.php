@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ $page_header }}</h3>
      <span class="pull-right"><a href="{{ route($link.'.index') }}" class="btn btn-warning">{!! VIEWLIST_ICON !!}</a></span>
    </div>
    <div class="box-body">
        <form method="POST" action="{{ route($link.'.update', $record->id) }} ">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="control-label" for="title">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $record->slug }}">
                    @error('slug')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                    <p class="pull-right"><u><a href="{{ route('page.detail',$record->slug) }}" target="_blank"> View Url</a></u></p>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $record->title }}" >
                    @error('title')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">Description <span class="text-danger">*</span></label>
                    <br>
                    <textarea id="my-editor" class="tinymce" name="description" placeholder="Place some text here" >{{ $record->description }}</textarea>
                    @error('description')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                </div>
                <hr>
                <h4>Meta Tags:</h4>
                <div class="form-group">
                    <label class="control-label" for="meta_keywords">Meta Keywords <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $record->meta_keywords }}" >
                </div>
                <div class="form-group">
                    <label class="control-label" for="meta_description">Meta Description <span class="text-danger">*</span></label>
                    <br>
                    <textarea name="meta_description" class="form-control" placeholder="Place some text here" rows="4">{{ $record->meta_description }}</textarea>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                {{-- <div class="form-group">
                   <label class="control-label">Featured Image</label>
                    @if (!empty($record->image))
                        <img src="{{ $record->image }}" alt="" title="" id="prev_img" />
                    @else
                        <img src="{{ asset('admin/images/no-image.png', $secure = null) }}" alt="" title="" id="prev_img" />
                    @endif
                    <a href="{{ url('/uploads/filemanager/dialog.php?type=1&field_id=image') }}" data-fancybox-type="iframe" class="btn btn-info fancy">Insert</a>
                    <button class="btn btn-danger remove_box_image" type="button">Remove</button>
                    <button class="btn btn-warning prev_box_image" type="button" style="display: none;">Previous Image</button>
                    <input type="hidden" value="{{ $record->image ?? '' }}"  name="image" class="form-control" id="image">
                </div>
                <hr> --}}
                {{-- <div class="form-group">
                   <label class="control-label">Facebook Image</label>
                    @if (!empty($record->fb_image))
                        <img src="{{ $record->fb_image }}" alt="" title="" id="prev_fb_image_img" />
                    @else
                        <img src="{{ asset('admin/images/no-image.png', $secure = null) }}" alt="" title="" id="prev_fb_image_img" />
                    @endif
                    <a href="{{ url('/uploads/filemanager/dialog.php?type=1&field_id=fb_image') }}" data-fancybox-type="iframe" class="btn btn-info fancy">Insert</a>
                    <button class="btn btn-danger remove_fb_image_img" type="button">Remove</button>
                    <button class="btn btn-warning prev_box_fb_image" type="button" style="display: none;">Previous Image</button>
                    <input type="hidden" value="{{ $record->fb_image ?? '' }}"  name="fb_image" class="form-control" id="fb_image">
                </div>
                <div class="form-group">
                    <label class="control-label" for="published_date">Published Date <span class="text-danger">*</span></label>
                    <input type="text" class="form-control datepicker" id="published_date" name="published_date" value="{{ $record->published_date }}">
                </div> --}}
                {{-- <hr>
                <div class="form-group">
                    <label class="control-label" for="show_homepage">Show on HomePage <span class="text-danger">*</span></label>
                    <br>
                    <label class="radio-inline">
                        <input type="radio" name="show_homepage" value="1" @if($record->show_homepage == 1) {{ 'checked' }} @endif> Yes 
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="show_homepage" value="0" @if($record->show_homepage == 0) {{ 'checked' }} @endif> No
                    </label>
                </div>
                <hr> --}}
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="statusid" class="form-control">
                        <option value="1" @if($record->status == '1') {{ 'selected' }} @endif >{!! PUBLISH !!}</option>
                        <option value="0" @if($record->status == '0') {{ 'selected' }} @endif >{!! UNPUBLISH !!}</option>
                    </select>
                </div>
               <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-danger resetbtn">Clear</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection