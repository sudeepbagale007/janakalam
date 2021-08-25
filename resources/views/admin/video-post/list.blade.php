@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $page_header }}</h3>
        <span class="pull-right"><a href="{{ route($link.'.create') }}" class="btn btn-warning">{!! ADD_ICON !!}</a></span>
    </div>
    <div class="box-body table-responsive">
        <table id="sortable" class="table table-striped table-hover todo-list ui-sortable" >
            <tr class="nodrag nodrop">
                <th>S.No</th>
                <th>Video Type</th>
                <th>Title</th>
                <th class="text-center">Published Date</th>
                <th class="text-center">Show on Homepage</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
            <?php $count = ($list->currentpage()-1)*$list->perpage()+1; ?>
            @if(!empty($list))
            @foreach ($list as $item)
            <tr>
                <td width='10px'>{{ $count++ }}</td>
                <td>{{ $item->type->title }}</td>
                <td>{{ str_limit($item->title, $limit = 50, $end = '...') }}</td>
                <td class="text-center">{{ $item->published_date }}</td>
                <td class="text-center">{!! getYesNo($item->show_on_homepage) !!}</td>
                <td class="text-center">{!! getStatus($item->status) !!}</td>
                <td class="text-center">
                    <a href="{{ route($link.'.edit', $item->id) }}"> {!! EDIT_ICON !!}</a>&nbsp;|
                    <a href="{{ route($link.'.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!} </a>
                </td>
            </tr>
            @endforeach
            @endif
        </table>
        {{ $list->links('vendor.pagination.bootstrap-4')
        }}
    </div>
</div>
@endsection