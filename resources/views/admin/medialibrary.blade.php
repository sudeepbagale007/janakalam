@extends('admin/app')
@section('content-header', 'DashBoard')
@section('content')
<iframe src="{{ url('/uploads/filemanager/dialog.php?type=1&field_id=image') }}" width="100%" height="550px"></iframe>
@endsection