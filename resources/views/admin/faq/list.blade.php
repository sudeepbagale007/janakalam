@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $page_header }}</h3>
        <span class="pull-right"><a href="{{ route($link.'.create') }}" class="btn btn-warning">{!! ADD_ICON !!}</a></span>
    </div>
    <div class="box-body table-responsive">
        <form method="POST" action="{{ route($linkx.'.store') }}">
            {{ csrf_field() }}
            <table id="sortable" class="table table-striped table-hover todo-list ui-sortable" >
                <tr class="nodrag nodrop">
                    <th><span class="handle"><i class="fa fa-arrows"></i></span></th>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="text-center">Published Date</th>
                    <th class="text-center">Total List</th>
                    <th class="text-center">Add FAQ List</th>
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
                    <td>{{ str_limit($item->title, $limit = 50, $end = '...') }}</td>
                    <td>{{ str_limit($item->description, $limit = 100, $end = '...') }}</td>
                    <td class="text-center">{{ $item->published_date }}</td>
                    <td class="text-center">{{ count($item->totallist) }}</td>
                    <td class="text-center"><a href="{{ route($link.'.edit', $item->id) }}"> {!! VIEW_ICON !!}</a></td>
                    <td class="text-center">{!! getStatus($item->status) !!}</td>
                    <td class="text-center">
                        <a href="{{ route($link.'.edit', $item->id) }}"> {!! EDIT_ICON !!}</a>&nbsp;|
                        <a href="{{ route($link.'.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!} </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </form>
    </div>
</div>
@push('script')
<script type="text/javascript">
    $('#sortable').tableDnD({
        onDrop: function (table, row) {
            $.post("{{ route('ajax.sorting') }}", {ids_order: $.tableDnD.serialize(), sort_orders: '<?php echo $sort_orders; ?>', table: 'tbl_faq', _token: '{!! csrf_token() !!}'});
        }
    });
</script>
@endpush
@endsection