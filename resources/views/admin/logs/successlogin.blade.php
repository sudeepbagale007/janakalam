@extends('admin.app')
@section('content')
<!-- Default box -->
<div class="col-md-10 box">
    <div class="box-header with-border">
        <h3 class="box-title">Login Logs</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-condensed dataTable">
                <thead class="bg-primary">
                    <tr>
                        <th>S.No</th>
                        <th>User Id</th>
                        <th>Username</th>
                        <th>Login Date</th>
                        <th>Device</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = ($list->currentpage()-1)*$list->perpage()+1; ?>
                    @foreach ($list as $item)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->login_date }}</td>
                        <td>{{ $item->login_device }}</td>
                        <td class="text-center">{{ $item->ip_address }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $list->links() }}
        </div>
    </div>
</div>
@endsection