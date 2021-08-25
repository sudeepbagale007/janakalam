@extends('admin/app')

@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $page_header }}
            </h3>
            <div class="pull-right">
                <a href="{{ route('album.index') }}" class="btn btn-primary"><i class="fa fa-chevron-left"></i>&nbsp; Back </a>
                <a href="{{ route('gallery.create') }}" class="btn btn-warning"><i class="fa fa-plus"></i>&nbsp; Add New </a>
            </div>
        </div>
        <div class="box-body">
            <form class="" method="POST" action="{{ route('gallery.store') }}">
                {{ csrf_field() }}
                <table id="sortable" class="table table-striped table-hover todo-list ui-sortable" >
                    <tr class="nodrag nodrop">
                        <th><span class="handle"><i class="fa fa-arrows"></i></span></th>
                        <th>Title</th>
                        <th class="text-center">Image</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    <?php $sort_orders = ''; ?>
                    @foreach ($list as $item)
                    <?php $sort_orders .= $item->sort_order . ','; ?>
                    <tr id="{{ $item->id }}">
                        <td class="move">
                            <span class="handle">
                                <i class="fa fa-ellipsis-v"></i>
                                <i class="fa fa-ellipsis-v"></i>
                            </span>
                        </td>
                        <td>{{ $item->title }}</td>
                        <td class="text-center">
                            <a href="{{ asset('site/uploads/gallery/'.$item->image, $secure = null) }}" target="_blank"><i class="fa fa-picture-o"></i></a>
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td class="text-center">
                            @if ($item->status == '1')
                                {!! ACTIVE_STATUS !!}
                            @else
                                {!! INACTIVE_STATUS !!}
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('gallery.edit', $item->id) }}"> {!! EDIT_ICON !!} </a> |
                            <a href="{{ route('gallery.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!} </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </form>
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript">
    $('#sortable').tableDnD({
        onDrop: function (table, row) {
            $.post("{{ route('ajax.sorting') }}", {ids_order: $.tableDnD.serialize(), sort_orders: '<?php echo $sort_orders; ?>', table: 'tbl_galleries', _token: '{!! csrf_token() !!}'});
        }
    });
</script>
@endpush
<div class="clearfix"></div>
@endsection