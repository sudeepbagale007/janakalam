@extends('admin.app')
{{-- @section('content-header',$page_header) --}}
@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="box box-info">
            @include('admin.dashboard.author_pie_chart')
        </div>
    </div>
    <div class="col-md-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $page_header }} Data</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-condensed dataTablePaginationSort compact">
                        <thead class="bg-primary">
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th class="text-right">Post</th>
                                <th class="text-right">Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; $totalviews =0; ?>
                            @if(!empty($list))
                            @foreach ($list as $item)
                            <?php
                            if (!empty($item->totalpost)) {
                                foreach ($item->totalpost as $kl => $val) {
                                    $totalviews+=$val->viewcount;
                                }
                            }
                            ?>
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $item->name}}</td>
                                <td class="text-right">{{ number_format(count($item->totalpost)) }}</td>
                                <td class="text-right">{{ number_format($totalviews) }}</td>
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
            </div>
        </div>
    </div>
</div>


<div class="row">
    @if(!empty($list))
    @foreach($list as $k => $item)
    <?php
        $totalviews =0;
        if (!empty($item->totalpost)) {
            foreach ($item->totalpost as $kl => $val) {
                $totalviews+=$val->viewcount;
            }
        }
    ?>
        <div class="col-md-6">
            <div class="box box-info">
            	<div class="box-header with-border">
            		<h3 class="box-title">{{ $item->name }} [Total News : <b>{{ number_format(count($item->totalpost)) }}</b>, Total Views : <b>{{ number_format($totalviews) }} </b>]</h3>
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
                                <?php $count = 1; //($list->currentpage()-1)*$list->perpage()+1; ?>
                                @if(!empty($item->totalpost))
                                @foreach ($item->totalpost as $itemx)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td title="{{ $itemx->title }}">{{ str_limit($itemx->title, $limit = 50, $end = '...') }}</td>
                                    <td><a href="{{ route('post.detail',$itemx->slug) }}" target="_blank" title="{{ $itemx->title }}">{!! LINK_ICON !!}</a></td>
                                    <td class="text-center">{{ $itemx->published_date }}</td>
                                    <td class="text-right">{{ number_format($itemx->viewcount) }}</td>
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
                </div>
            </div>
        </div>
    @endforeach
    @endif
</div>
@endsection