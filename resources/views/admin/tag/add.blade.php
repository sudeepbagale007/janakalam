@extends('admin.app')
@section('content')
<div class="row">
    <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
        @include('admin.tag.table')
    </div>
    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add Tags</h3>
            </div>
            <div class="box-body">
                <form method="POST" action="{{ route($link.'.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label" for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" >
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