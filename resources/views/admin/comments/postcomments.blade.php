@extends('admin.app')
@section('content')
@if(session('success'))
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{session('success')}}
        </div>
    </div>
    @endif
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">List of Comments</h3>
    </div>
    <div class="box-body">
        <div class="clearfix"></div>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-condensed dataTable compact">
                <thead class="bg-primary">
                    <tr>
                        <th>S.No</th>
                        <th>Post Title</th>
                        <th class="text-center">Comment</th>
                        <th class="text-center">likes </th>
                        <th class="text-center">Dislikes</th>
                        <th class="text-center">Report</th>
                        {{-- <th class="text-center">Action</th> --}}
                        <th class="text-center">Published Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @if(!empty($post_comments))
                    @foreach ($post_comments as $item)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{!! str_limit(strip_tags($item->title),200) !!}</td>
                            <td class="text-center">{{$item->comment}}</td>
                            <td class="text-center">@if($item->comment_like){{$item->comment_like}}@else 0 @endif</td>   
                            <td class="text-center">@if($item->comment_dislike){{$item->comment_dislike}}@else 0 @endif</td>   
                            <td class="text-center">@if($item->comment_report){{$item->comment_report}}@else 0 @endif</td>
                            {{-- <td class="text-center">
                                <a href="{{ route('janamat.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!} </a>
                            </td> --}}
                            <td class="text-center">{{$item->c_date}}</td>
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
        {{-- {{ $list
            ->appends(Request::only('published_date'))
            ->appends(Request::only('title'))
            ->links('vendor.pagination.bootstrap-4')
        }} --}}
    </div>
</div>
@endsection