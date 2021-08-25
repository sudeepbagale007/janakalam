@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">List of Admin User</h3>
        <span class="pull-right"><a href="{{ route('user.create') }}" class="btn btn-warning">{!! ADD_ICON !!}</a></span>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-condensed compact dataTable">
                <thead class="bg-primary">
                    <tr>
                        <th>S.No</th>
                        <th>UserName</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Mobile No</th>
                        <th class="text-center">Last Login Date</th>
                        <th class="text-center">Created Date</th>
                        <th class="text-center">Admin Roles</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @foreach ($result['userlist'] as $item)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="text-center">{{ $item->mobileno }}</td>
                        <td class="text-center">{{ $item->lastlogin }}</td>
                        <td class="text-center">{{ $item->created_at }}</td>
                        <td class="text-center">{{ $item->admingroup->title }}</td>
                        <td class="text-center">{!! getStatus($item->status) !!}</td>
                        <td width="100px" class="text-center">
                            <a href="{{ route('user.edit',$item->id) }}">{!! EDIT_ICON !!} </a>
                            @if($item->id != '1')
                            <a href="{{ route('user.delete', $item->id) }}"  class="resetbtn">&nbsp; | &nbsp; {!! DELETE_ICON !!}</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection