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
                    <label class="control-label" for="video_url">Youtube Url <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="video_url" name="video_url" value="{{ $record->video_url }}" >
                    @error('video_url')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                    <p>Note: Copy the full url</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="status">Video Type</label>
                    <select name="video_type_id" id="statusid" class="form-control">
                        @foreach($type as $item)
                        <option value="{{ $item->id }}" @if($record->video_type_id == $item->id) {{ 'selected' }} @endif>{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Show on Homepage</label>
                    <select name="show_on_homepage" id="statusid" class="form-control">
                        <option value="1" @if($record->show_on_homepage == '1') {{ 'selected' }} @endif >Yes</option>
                        <option value="0" @if($record->show_on_homepage == '0') {{ 'selected' }} @endif >No</option>
                    </select>
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