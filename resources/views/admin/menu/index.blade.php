@extends('admin.app')
@section('content')
<!-- Default box -->
<div class="col-md-10 box">
    <div class="box-header with-border">
        <h3 class="box-title">Menu Builder</h3>
    </div>
    <div class="box-body">
        {!! Menu::render() !!}
    </div>
</div>
{!! Menu::scripts() !!}
@endsection