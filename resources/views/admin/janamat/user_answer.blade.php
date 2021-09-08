@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">List of {!! str_limit(strip_tags($janamat->question),200) !!} Answers</h3>
    </div>
    <div class="" style="margin: 5px">
        <?php $janamat_answers=explode(',',$janamat->answers); ?>
        @foreach($selected_answer as $row)
            @php       
                $index=substr($row->selected_answer,6);
            @endphp
            <h4 class="janamat_answers p-5">{{$janamat_answers[$index]}}: {{$row->total}} </h4>          
        @endforeach
    </div>
    <div class="box-body">
        <div class="clearfix"></div>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-condensed dataTable compact">
                <thead class="bg-primary">
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th class="text-center">Selected Answers</th>
                        <th class="text-center">User Email</th>
                        <th class="text-center">Submitted at</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @if(!empty($user_answers))
                    @foreach ($user_answers as $user_answer)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{!! str_limit(strip_tags($user_answer->question),200) !!}</td>
                        <td class="text-center">
                            @php $index=substr($user_answer->selected_answer,6); @endphp
                            {{$janamat_answers[$index]}}
                        </td>
                        <td class="text-center">{{ $user_answer->user_email }}</td>
                        <td class="text-center">{{ $user_answer->created_at }}</td>
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