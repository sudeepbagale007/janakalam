@extends('admin.app')
@section('content')
<div class="row">
    <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
        @include('admin.category.table')
    </div>
    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add Category</h3>
            </div>
            <div class="box-body">
                <form class="" method="POST" action="{{ route($link.'.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Select Parent Category</label>
                        <select class="form-control select2" name="parent_id" id="parent_id">
                            <option value="0">Set As Parent Category</option>
                            @if(!empty($list))
                            @foreach ($list as $kl => $item)
                                <option value="{{ $item->id }}">{{ $item->title}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Choose Template</label>
                        <select class="form-control select2" name="template_id" id="template_id">
                            <option value="">Choose Template</option>
                            @if(!empty($template_list))
                            @foreach ($template_list as $kl => $item)
                                <option value="{{ $item->id }}">{{ $item->title}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('template_id')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" autocomplete="off" name="title" required value="{{ old('title') }}" >
                        @error('title')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror
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
@endsection