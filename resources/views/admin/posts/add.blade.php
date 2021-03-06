@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ $page_header }}</h3>
      <span class="pull-right"><a href="{{ route('posts.index') }}" class="btn btn-warning">{!! VIEWLIST_ICON !!}</a></span>
    </div>
    <div class="box-body">
        <form method="POST" action="{{ route('posts.store') }}" id="frm-post">
            {{ csrf_field() }}
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="control-label" for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" >
                    @error('title')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="control-label" for="short_text">Sub Heading</label>
                    <input type="text" class="form-control" name="sub_heading" value="{{ old('sub_heading') }}" />
                </div>
                <div class="form-group">
                    <label class="control-label" for="short_text">Short Banner Text</label>
                    <input type="text" class="form-control" name="short_text" value="{{ old('short_text') }}" />
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">Description <span class="text-danger">*</span></label>
                    <br>
                    <textarea id="my-editor" class="tinymce" name="description" placeholder="Place some text here" >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Choose Author</label>
                            <select class="form-control select2" name="author_id" id="author_id">
                                <option value="">Choose Author</option>
                                @if(!empty($authorlist))
                                @foreach($authorlist as $item)
                                <option value="{{ $item->id }}" @if(old('author_id') == $item->id) {{ 'selected' }} @endif>{{ $item->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="author_name">Author Name</label>
                            <input type="text" class="form-control" name="author_name" value="{{ old('author_name') }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="video_url">Video Url</label>
                            <input type="text" class="form-control" name="video_url" value="{{ old('video_url') }}" />
                            <p>Note: Copy the full url from the youtube</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="interviewer_name">Interviewer Name</label>
                            <input type="text" class="form-control" name="interviewer_name" value="{{ old('interviewer_name') }}" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="breaking_news">Breaking News <span class="text-danger">*</span></label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="breaking_news" value="1" checked> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="breaking_news" value="0"> No
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="stick_news">Stick News <span class="text-danger">*</span></label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="stick_news" value="1"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="stick_news" value="0" checked> No
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="stick_news">Pin News <span class="text-danger">*</span></label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="pin" value="1"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="pin" value="0" checked> No
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="show_image">Show Featured Image <span class="text-danger">*</span></label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="show_image" value="1" checked> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="show_image" value="0"> No
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="published_date">Published Date <span class="text-danger">*</span></label>
                            <input type="text" class="form-control datetimepicker" id="published_date" name="published_date" value="{{ date('Y-m-d H:i') }}" >
                        </div>
                    </div>
                </div>
                
                <hr>
                <h4>Meta Tags:</h4>
                <div class="form-group">
                    <label class="control-label" for="meta_keywords">Meta Keywords </label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" >
                </div>
                <div class="form-group">
                    <label class="control-label" for="meta_description">Meta Description </label>
                    <br>
                    <textarea name="meta_description" class="form-control" placeholder="Place some text here" rows="4">{{ old('meta_description') }}</textarea>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="published_date">Choose Category <span class="text-danger">*</span></label>
                    <div style="height: 300px; overflow-y: scroll;">
                        <ul class="list-unstyled">
                            @if(!empty($categorylist))
                                @foreach($categorylist as $cat)
                                    @if(!empty($cat->childlist))
                                        <li>
                                            <input type="checkbox" name="category[]" value="{{ $cat->id }}"> {{ $cat->title }}
                                            <ul>
                                                @foreach($cat->childlist as $child)
                                                    <li><input type="checkbox" name="category[]" value="{{ $child->id }}"> {{ $child->title }}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li><input type="checkbox" name="category[]" value="{{ $cat->id }}"> {{ $cat->title }}</li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    @error('category')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                </div>
                <hr>
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
                    <input type="hidden" value="{{ isset($record->image)?asset($record->image) :'' }}"  name="image" class="form-control" id="image">
                </div>
                <hr>
                <div class="form-group">
                   <label class="control-label">Facebook Image</label>
                    @if (!empty($record->fb_image))
                        <img src="{{ asset($record->fb_image) }}" alt="" title="" id="prev_fb_image_img" />
                    @else
                        <img src="{{ asset('admin/images/no-image.png', $secure = null) }}" alt="" title="" id="prev_fb_image_img" />
                    @endif
                    <a href="{{ url('/uploads/filemanager/dialog.php?type=1&field_id=fb_image') }}" data-fancybox-type="iframe" class="btn btn-info fancy">Insert</a>
                    <button class="btn btn-danger remove_fb_image_img" type="button">Remove</button>
                    <button class="btn btn-warning prev_box_fb_image" type="button" style="display: none;">Previous Image</button>
                    <input type="hidden" value="{{ isset($record->fb_image)?asset($record->fb_image) :'' }}"  name="fb_image" class="form-control" id="fb_image">
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
                    <button type="reset" class="btn btn-danger resetbtn">Clear</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $('#frm-post').submit(function(event) {
        var checked = $("input[type=checkbox]:checked").length;
        if(!checked) {
            alert("You must check at least one checkbox.");
            return false;
        }
    });
</script>
@endpush
@endsection