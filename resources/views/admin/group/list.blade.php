@extends('admin.app')
@section('content')
<!-- Default box -->
<div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
    @include('admin.group.table')
</div>
<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add Group User</h3>
        </div>
        <div class="box-body">
            <form method="POST" action="{{ route('usergroup.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                    @error('title')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="5">{!! old('description') !!}</textarea>
                    @error('description')
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
@endsection