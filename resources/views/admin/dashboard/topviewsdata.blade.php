@extends('admin.app')
{{-- @section('content-header',$page_header) --}}
@section('content')
<div class="box box-info">
	@include('admin.dashboard.topviews_chart')
</div>
<div class="row">
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $page_header }} Table</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-condensed dataTablePaginationSort compact">
                        <thead class="bg-primary">
                            <tr>
                                <th>S.No</th>
                                <th>Title</th>
                                <th>Link</th>
                                <th class="text-center">Date</th>
                                <th class="text-right">Views Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; $totalviews = 0; //($list->currentpage()-1)*$list->perpage()+1; ?>
                            @if(!empty($list))
                            @foreach ($list as $item)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td title="{{ $item->title }}">{{ str_limit($item->title, $limit = 80, $end = '...') }}</td>
                                <td><a href="{{ route('post.detail',$item->slug) }}" target="_blank" title="{{ $item->title }}">{!! LINK_ICON !!}</a></td>
                                <td class="text-center">{{ $item->published_date }}</td>
                                <td class="text-right">{{ number_format($item->viewcount) }}</td>
                            </tr>
                            <?php $totalviews+= $item->viewcount ?>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">{!! NO_RECORD !!}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $page_header }} Table</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead class="bg-primary">
                            <tr>
                                <th>Date</th>
                                <th class="text-center">Post Count</th>
                                <th class="text-center">Views Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $startdate.' -'.$enddate }}</td>
                                <td class="text-center">{{ number_format(count($list)) }}</td>
                                <td class="text-center">{{ number_format($totalviews) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection