@extends('admin.app')
@section('content')
<!-- Default box -->
<div class="col-md-10 box">
    <div class="box-header with-border">
        <h3 class="box-title">Fail Login Logs</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-condensed dataTable">
                <thead class="bg-primary">
                    <tr>
                        <th>S.No</th>
                        <th>Username</th>
                        <th>Fail Password</th>
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
                        <td>{{ $item->user_name }}</td>
                        <td>{{ $item->fail_password }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->login_device }}</td>
                        <td class="center-align">{{ $item->ip_address }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $list->links() }}
        </div>
    </div>
</div>
@endsection