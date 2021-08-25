@extends('admin.app')
@section('content')
<?php $record = $result['record']; ?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $result['page_header'] }}</h3>
        <span class="pull-right"><a href="{{ route('user.list') }}" class="btn btn-warning">{!! VIEWLIST_ICON !!}</a></span>
    </div>
    <div class="box-body">
        <form class="form-horizontal" method="POST" action="{{ route('user.update', $record->id) }} ">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <select name="user_group_id" id="user_group_id" class="form-control">
                        @foreach($result['admingroup'] as $list)
                        <option value="{{ $list->id }}" @if($list->id == $record->user_group_id) selected @endif>{{ $list->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" placeholder="Enter Full Name " name="name" value="{{ $record->name  }}" required autofocus>
                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" placeholder="Enter Email Address" name="email" value="{{ $record->email }}" required>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('mobileno') ? ' has-error' : '' }}">
                <label for="mobileno" class="col-md-4 control-label">Mobile Number <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input id="mobileno" type="number" class="form-control" placeholder="Enter Mobile Number" name="mobileno" value="{{ $record->mobileno }}" >
                    @if ($errors->has('mobileno'))
                    <span class="help-block">
                        <strong>{{ $errors->first('mobileno') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="col-md-4 control-label">UserName <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input id="username" type="text" class="form-control" placeholder="Enter UserName" name="username" value="{{ $record->username }}" >
                    @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="col-md-4 control-label">&nbsp; </label>
                <div class="col-md-6">
                    <input id="changepwd" type="checkbox" name="changepwd" >Change Password
                </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" placeholder="Enter Password" name="password" disabled required>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" placeholder="Enter Confirm Password" name="password_confirmation" disabled required>
                </div>
            </div>
            @if($record->id != '1')
            <div class="form-group">
                <label for="status" class="col-md-4 control-label">Status <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <select name="status" id="statusid" class="form-control">
                        <option value="1" <?= isset($record->status) && ($record->status == '1')? 'selected' : '' ?> >{!! PUBLISH !!}</option>
                        <option value="0" <?= isset($record->status) && ($record->status == '0')? 'selected' : '' ?> >{!! UNPUBLISH !!}</option>
                    </select>
                </div>
            </div>
            @endif
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-danger resetbtn">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
$('#changepwd').removeAttr('checked');
$('#changepwd').click(function () {
//check if checkbox is checked
if ($(this).is(':checked')) {
$('#password').removeAttr('disabled'); //enable input
$('#password-confirm').removeAttr('disabled'); //enable input
} else {
$('#password').attr('disabled', true); //disable input
$('#password-confirm').attr('disabled', true); //disable input
}
});
});
</script>
@endpush
@endsection