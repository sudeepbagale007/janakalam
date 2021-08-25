@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $page_header }}</h3>
        <span class="pull-right"><a href="{{ route($link.'.create') }}" class="btn btn-warning">{!! ADD_ICON !!}</a></span>
    </div>
    <div class="box-body">
        <form class="">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Title (English)</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ isset($_GET['title'])?$_GET['title']:'' }}" placeholder="Search By Title (English)">
                </div>
            </div>
            <div class="col-md-4">
                <label>Select Advertisement Type</label>
                <select name="advertisement_id" id="advertisement_id" class="form-control select2">
                    <option value="">Select Advertisement Type</option>
                    @if(!empty($advertisement_list))
                    @foreach($advertisement_list as $kl => $item)
                        <option value="{{ $item->id }}" @if(isset($_GET['advertisement_id']) && $_GET['advertisement_id'] == $item->id) {{ 'selected' }} @endif>{{ $item->title }}</option>
                    @endforeach
                    @endif
                </select>
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
            <form method="POST" action="{{ route($link.'.store') }}">
                {{ csrf_field() }}
                <table id="sortable" class="table table-striped table-hover todo-list ui-sortable" >
                    <tr class="nodrag nodrop">
                        <th><span class="handle"><i class="fa fa-arrows"></i></span></th>
                        <th>Section</th> 
                        <th>Title</th>
                        <th class="text-center">Open Image</th>
                        <th class="text-center">Start Time</th>
                        <th class="text-center">End Time</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    <?php $sort_orders = ''; ?>
                    @foreach ($list as $item)
                    <?php $sort_orders .= $item->sort_order . ','; ?>
                    <tr id="{{ $item->id }}">
                        <td width='10px' class="move">
                            <span class="handle">
                                <i class="fa fa-ellipsis-v"></i>
                                <i class="fa fa-ellipsis-v"></i>
                            </span>
                        </td>
                         <td>{{ $item->adtype->title }}</td> 
                        <td>{{ str_limit($item->title, $limit = 50, $end = '...') }}</td>
                        <td class="text-center"><a href="{{ url($item->image) }}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                        <td class="text-center">{{ $item->start_time }}</td>
                        <td class="text-center">{{ $item->end_time }}</td>
                        <td class="text-center">{!! getStatus($item->status) !!}</td>
                        <td class="text-center">
                            <a href="{{ route($link.'.edit', $item->id) }}"> {!! EDIT_ICON !!}</a>&nbsp;|
                            <a href="{{ route($link.'.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!} </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </form>
            {{ $list->links() }}
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript">
    $('#sortable').tableDnD({
        onDrop: function (table, row) {
            $.post("{{ route('ajax.sorting') }}", {ids_order: $.tableDnD.serialize(), sort_orders: '<?php echo $sort_orders; ?>', table: 'tbl_advertisement', _token: '{!! csrf_token() !!}'});
        }
    });
</script>
@endpush
@endsection