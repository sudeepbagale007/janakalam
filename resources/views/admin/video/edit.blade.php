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
                    <label class="control-label" for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $record->title }}" >
                    @error('title')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="control-label" for="youtube_url">Youtube Url <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="youtube_url" name="youtube_url" value="{{ 'https://www.youtube.com/watch?v='.$record->youtube_url }}" >
                    @error('youtube_url')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                    <p>Note: Copy the full url from the youtube</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                   <label class="control-label">Featured Image</label>
                    @if (!empty($record->image))
                        <img src="{{ asset($record->image) }}" alt="" title="" id="prev_img" />
                    @else
                        <img src="{{ asset('admin/images/no-image.png', $secure = null) }}" alt="" title="" id="prev_img" />
                    @endif
                    <a href="{{ url('/uploads/filemanager/dialog.php?type=1&field_id=image') }}" data-fancybox-type="iframe" class="btn btn-info fancy">Insert</a>
                    <button class="btn btn-danger remove_box_image" type="button">Remove</button>
                    <button class="btn btn-warning prev_box_image" type="button" style="display: none;">Previous Image</button>
                    <input type="hidden" value="{{ asset($record->image) ?? '' }}"  name="image" class="form-control" id="image">
                </div>
                <div class="form-group">
                    <label class="control-label" for="published_date">Published Date <span class="text-danger">*</span></label>
                    <input type="text" class="form-control datepicker" id="published_date" name="published_date" value="{{ $record->published_date }}">
                </div>
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