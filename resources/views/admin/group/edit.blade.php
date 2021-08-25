@extends('admin.app')
@section('content')
<!-- Default box -->
<div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
    @include('admin.group.table')
</div>
<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Group User</h3>
            <span class="pull-right"><a href="{{ route('usergroup.index') }}" class="btn btn-warning">{!! ADD_ICON !!}</a></span>
        </div>
        <div class="box-body">
            <form method="POST" action="{{ route('usergroup.update', $record->id) }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $record->title }}">
                    @error('title')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="5">{!! $record->description !!}</textarea>
                    @error('description')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="statusid" class="form-control">
                        <option value="1" @if($record->status == '1') {{ 'selected' }} @endif>{!! PUBLISH !!}</option>
                        <option value="0" @if($record->status == '0') {{ 'selected' }} @endif>{!! UNPUBLISH !!}</option>
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