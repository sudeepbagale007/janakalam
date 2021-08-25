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
                    <label class="control-label" for="title">Advertisement Type <span class="text-danger">*</span></label>
                    <select name="advertisement_id" id="advertisement_id" class="form-control">
                        <option value="">Select Advertisement Type</option>
                        @if(!empty($advertisement_list))
                        @foreach($advertisement_list as $kl => $item)
                            <option value="{{ $item->id }}" @if($record->advertisement_id == $item->id) {{ 'selected' }} @endif>{{ $item->title }}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('advertisement_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('advertisement_id') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $record->title }}" >
                    @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>
                 <div class="form-group">
                    <label class="control-label" for="url">Link <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="url" name="url" value="{{ $record->url }}" >
                    @if ($errors->has('url'))
                    <span class="help-block">
                        <strong>{{ $errors->first('url') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="start_time">Ad Start Date Time <span class="text-danger">*</span></label>
                            <input type="text" class="form-control datetimepicker" id="start_time" name="start_time" value="{{ $record->start_time }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="end_time">Ad End Date Time <span class="text-danger">*</span></label>
                            <input type="text" class="form-control datetimepicker" id="end_time" name="end_time" value="{{ $record->end_time }}" >
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label>Image - Recommended Size (1350*450)</label>
                    <?php if (!empty($record->image)) { ?>
                    <img src="<?php echo url($record->image) ?>" alt="" title="" id="prev_img" />
                    <?php } else { ?>
                    <img src="{{ asset('admin/images/no-image.png', $secure = null) }}" alt="" title="" id="prev_img" />
                    <?php } ?>
                    @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                    @endif
                    <a href="<?php echo url('/uploads/filemanager/dialog.php?type=1&field_id=image') ?>" data-fancybox-type="iframe" class="btn btn-info fancy">Insert</a>
                    <button class="btn btn-danger remove_box_image" type="button">Remove</button>
                    <button class="btn btn-warning prev_box_image" type="button" style="display: none;">Previous Image</button>
                    <input type="hidden" value="<?php echo isset($record->image)?url($record->image):'' ?>"  name="image" class="form-control" id="image">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="statusid" class="form-control">
                        <option value="1" <?= isset($record->status) && ($record->status == '1')? 'selected' : '' ?> >{!! PUBLISH !!}</option>
                        <option value="0" <?= isset($record->status) && ($record->status == '0')? 'selected' : '' ?> >{!! UNPUBLISH !!}</option>
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