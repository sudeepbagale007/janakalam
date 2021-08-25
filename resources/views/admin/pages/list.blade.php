@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $page_header }}</h3>
        <span class="pull-right"><a href="{{ route($link.'.create') }}" class="btn btn-warning">{!! ADD_ICON !!}</a></span>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-hover table-condensed dataTable">
            <thead class="bg-primary">
                <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th class="text-center">Link</th>
                    <th class="text-center">Published Date</th>
                    <th class="text-center">Total Views</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; //($list->currentpage()-1)*$list->perpage()+1; ?>
                @if(!empty($list))
                @foreach ($list as $item)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ str_limit($item->title, $limit = 50, $end = '...') }}</td>
                    <td class="text-center"><a href="{{ route('page.detail',$item->slug) }}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                    <td class="text-center">{{ $item->published_date }}</td>
                    <td class="text-center">{{ number_format($item->viewcount) }}</td>
                    <td class="text-center">{!! getStatus($item->status) !!}</td>
                    <td class="text-center">
                        <a href="{{ route($link.'.edit', $item->id) }}"> {!! EDIT_ICON !!}</a>&nbsp;|
                        <a href="{{ route($link.'.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!} </a>
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
        {{-- {{ $list->links() }} --}}
    </div>
</div>
@endsection