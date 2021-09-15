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
                        <th class="text-center">Action</th>
                        <th class="text-center">Published Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @if(!empty($post_comments))
                    @foreach ($post_comments as $item)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{!! str_limit(strip_tags($item->question),200) !!}</td>
                            <td class="text-center">{!!$item->answers!!}</td>
                            @if($selected_answer!='[]')
                                <td>
                                    <div>
                                        @foreach($selected_answer as $row)
                                            @php 
                                            $answer=explode(',',$item->answers);    
                                            $index=substr($row->selected_answer,6);
                                            @endphp
                                            <li>{{$answer[$index]}}: {{$row->total}}</li>
                                        @endforeach    
                                    </div>
                                </td>
                            @else 
                                <td class="text-center">0</td>
                            @endif    
                            <td class="text-center">@if($janamat_count)<a href="{{route('user-answer',$item->id)}}">{{$janamat_count}} @else 0 @endif</a></td>
                            <td class="text-center">Active</td>
                            <td class="text-center">
                                <a href="{{ route('janamat.edit', $item->id) }}"> {!! EDIT_ICON !!}</a>&nbsp;|
                                <a href="{{ route('janamat.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!} </a>
                            </td>
                            <td class="text-center">{{ $item->created_at }}</td>
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