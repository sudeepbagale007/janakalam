@extends('admin.app')
@section('content')
<!-- Default box -->
<div class="row">
    <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
        @include('admin.category.table')
    </div>
    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Category</h3>
            </div>
            <div class="box-body">
                <form method="POST" action="{{ route($link.'.update', $record->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="title">Select Parent Category</label>
                        <select class="form-control select2" name="parent_id" id="parent_id">
                            <option value="0" {{ ($record->parent_id == 0)? 'selected' : '' }}>Set As Parent Category</option>
                            @if(!empty($list))
                            @foreach ($list as $kl => $item)
                                <option value="{{ $item->id }}" {{ ($record->parent_id == $item->id)? 'selected' : '' }}>{{ $item->title}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Choose Template</label>
                        <select class="form-control select2" name="template_id" id="template_id">
                            @if(!empty($template_list))
                            @foreach ($template_list as $kl => $item)
                                <option value="{{ $item->id }}" {{ ($record->template_id == $item->id)? 'selected' : '' }}>{{ $item->title}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('template_id')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" autocomplete="off" value="{{ $record->title }}">
                        @error('title')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" autocomplete="off" value="{{ $record->slug }}">
                        @error('slug')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="statusid" class="form-control">
                            <option value="1" <?= isset($record->status) && ($record->status == '1')? 'selected' : '' ?> >{!! PUBLISH !!}</option>
                            <option value="0" <?= isset($record->status) && ($record->status == '0')? 'selected' : '' ?> >{!! UNPUBLISH !!}</option>
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