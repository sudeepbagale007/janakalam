@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $page_header }}</h3>
        <span class="pull-right"><a href="{{ route($link.'.create') }}" class="btn btn-warning">{!! ADD_ICON !!}</a></span>
    </div>
    <div class="box-body table-responsive">
            <table class="table table-hover table-sm">
            <thead class="bg-primary">
                <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Feature Image</th>
                    <th class="text-center">Add Gallery</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(!$list->isEmpty())
                <?php $i=1; ?>
                @foreach ($list as $item)
                <tr>
                    <th scope=row>{{$i++}}</th>
                    <td class="text-center">{{ $item->title }}</td>
                    <td>{!!str_limit($item->description, $limit = 100, $end = '...') !!}</td>
                    <td class="text-center"><a href="{{ url($item->image) }}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                    <td class="text-center"> <a href="{{ route('albumGallery', $item->id) }}"> Add Gallery</a></td>

                    <td class="text-center">
                        @if ($item->status == '1')
                        {!! ACTIVE_STATUS !!}
                        @else
                        {!! INACTIVE_STATUS !!}
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route($link.'.edit', $item->id) }}"> {!! EDIT_ICON !!}</a>&nbsp;|
                        <a href="{{ route($link.'.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!} </a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="text-center">
                    <td colspan="7">{!! NO_RECORD !!}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection