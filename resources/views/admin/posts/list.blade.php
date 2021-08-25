@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $page_header }}</h3>
        <span class="pull-right"><a href="{{ route('posts.create') }}" class="btn btn-warning">{!! ADD_ICON !!}</a></span>
    </div>
    <div class="box-body">
        <form class="">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Title (English)</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ isset($_GET['title'])?$_GET['title']:'' }}" placeholder="Search By Title (English)">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control datepicker" id="published_date" name="published_date" autocomplete="off" value="{{ isset($_GET['published_date'])?$_GET['published_date']:'' }}" placeholder="Search By Date">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Search By Category</label>
                    <select class="form-control select2" name="category" id="category">
                        <option value="">Search By Category</option>
                        @if(!empty($categorylist))
                            @foreach($categorylist as $cat)
                                <option value="{{ $cat->id }}" @if(isset($_GET['category']) && $_GET['category'] == $cat->id) {{ 'selected' }} @endif>{{ $cat->title }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="vi-hidden">x</label>
                    <button type="submit" class="btn btn-default">Search</button>
                    <a href="{{ route($link.'.index') }}" class="btn btn-danger">Reset</a>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-condensed dataTable compact">
                <thead class="bg-primary">
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th class="text-center">Open Link</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Show Image</th>
                        <th class="text-center">Published Date</th>
                        <th class="text-center">Total Views</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = ($list->currentpage()-1)*$list->perpage()+1; ?>
                    @if(!empty($list))
                    @foreach ($list as $item)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ str_limit($item->title, $limit = 80, $end = '...') }}</td>
                        <td class="text-center"><a href="{{ route('post.detail',$item->slug) }}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                        <td class="text-center">
                            @if(!empty($item->category))
                            <ul class="list-unstyled">
                                @foreach($item->category as $cat)
                                <span class="label label-default">{{ $cat->title }}</span>
                                @endforeach
                            </ul>
                            @endif
                        </td>
                        <td class="text-center">{!! getYesNo($item->show_image) !!}</td>
                        <td class="text-center">{{ $item->published_date }}</td>
                        <td class="text-center">{{ $item->viewcount }}</td>
                        <td class="text-center">{!! getStatus($item->status) !!}</td>
                        <td class="text-center">
                            <a href="{{ route('posts.edit', $item->id) }}"> {!! EDIT_ICON !!}</a>&nbsp;|
                            <a href="{{ route('posts.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!} </a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5">{!! NO_RECORD !!}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        {{ $list
            ->appends(Request::only('published_date'))
            ->appends(Request::only('category'))
            ->appends(Request::only('title'))
            ->links('vendor.pagination.bootstrap-4')
        }}
    </div>
</div>
@endsection