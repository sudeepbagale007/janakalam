@extends('admin/app')

@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{ $page_header }}</h3>
          <span class="pull-right"><a href="{{route('admin.gallery.album',Cache::get($remember_page)) }}" class="btn btn-warning"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;  View List </a></span>
        </div>
        <div class="box-body">
            <form class="" method="POST" action="{{ route('gallery.update', $record->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label class="control-label" for="title">Title (English)</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $record->title }}" >
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            Upload Image <span>*</span>
                            <p class="help-note">Size : (800 x 600) px <br>[ .jpg, .png, .gif ]</p>
                        </label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" id="image" name="image" value="{{ $record->image }}">
                             @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                         @if (isset($record) && $record->image)
                            <div class="col-md-3 form-image">
                                <a class="image_zoom lumos-link" data-lumos="gallery1" href="{{ asset($record->upload.$record->image) }}" target="_blank">
                                    <img src="{{ asset($record->thumb.$record->image) }}" alt="{{ $record->title }}" class="img-thumbnail image_list" />
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="statusid" class="form-control">
                            <option value="1" <?= isset($record->status) && ($record->status == '1')? 'selected' : '' ?> >{!! PUBLISH !!}</option>
                            <option value="0" <?= isset($record->status) && ($record->status == '0')? 'selected' : '' ?> >{!! UNPUBLISH !!}</option>
                        </select>
                    </div>
                   <div class="form-group">
                        <input type="hidden" name="id" value="{{ $record->id }}">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="reset" class="btn btn-danger resetbtn">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="clearfix"></div>
@endsection