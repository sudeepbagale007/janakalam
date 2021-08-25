@extends('admin.app')
@section('content')
<div class="row">
    <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $page_header }}</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover table-sm dataTablePagination compact">
                    <thead class="bg-primary">
                        <tr>
                            <th width="10px">S.No</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th width="50px">Status</th>
                            <th width="50px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        @foreach ($images as $item)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $item->title }}</td>
                            <td class="text-center"><a href="{{ url($item->image) }}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                            <td class="center-align">
                                @if ($item->status == '1')
                                {!! ACTIVE_STATUS !!}
                                @else
                                {!! INACTIVE_STATUS !!}
                                @endif
                            </td>
                            <td width="100px" class="center-align">
                                <a href="{{ route('albumGalleryEdit', [$list->id,$item->id]) }}">{!! EDIT_ICON !!} </a>&nbsp;|&nbsp;
                                <a href="{{ route('albumGalleryDelete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!}</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
        <div class="box">
            <div class="box-header with-border">{{ $page_header }}
                <span class="pull-right"><a href="{{ route('album.index') }}" class="btn btn-warning">{!! VIEWLIST_ICON !!}</a></span>
            </div>
            <div class="box-body">
                <form class="" method="POST" action="{{ route('galleryStore',$list->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title">
                        @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="control-label">Featured Image</label>
                            @if(!empty($record->feature_image))
                            <img src="{{ $record->image }}" alt="" title="" class='fancybox' id="prev_img" />
                            @elseif(!empty(old('image')))
                            <img src="{{ old('image') }}" alt="" title="" class='fancybox' id="prev_img" />
                            @else
                            <img src="{{ asset('admin/images/no-image.png', $secure = null) }}" alt="" class='fancybox' title="" id="prev_img" />
                            @endif
                            <a href="{{ url('/uploads/filemanager/dialog.php?type=1&field_id=image') }}" data-fancybox-type="iframe" class="btn btn-info fancy">Insert</a>
                            <button class="btn btn-danger remove_box_image" type="button">Remove</button>
                            <button class="btn btn-warning prev_box_image" type="button" style="display: none;">Previous Image</button>
                            <input type="hidden" value="{{ isset($record->image)?$record->image:old('image') }}"  name="image" class="form-control" id="image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="statusid" class="form-control">
                            <option value="1">{!! PUBLISH !!}</option>
                            <option value="0">{!! UNPUBLISH !!}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection