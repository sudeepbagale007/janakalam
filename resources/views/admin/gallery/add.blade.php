@extends('admin/app')

@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{ $page_header }}</h3>
          <span class="pull-right"><a href="{{ route('admin.gallery.album',Cache::get($remember_page)) }}" class="btn btn-warning"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;  View List </a></span>
        </div>
        <div class="box-body">
            <form class="" method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="control-label" for="image">Upload Image <span>*</span>Size : (800 x 600) px </label>
                        <input type="file" class="form-control" id="image" name="image[]" multiple>
                         @if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="statusid" class="form-control">
                            <option value="1">{!! PUBLISH !!}</option>
                            <option value="0">{!! UNPUBLISH !!}</option>
                        </select>
                    </div>
                   <div class="form-group">
                        <input type="hidden" name="parent_id" value="{{ Cache::get($remember_page) }}">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-danger resetbtn">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="clearfix"></div>
@endsection