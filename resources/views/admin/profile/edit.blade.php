@extends('admin.app')
@section('content')
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Adit User Profile</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{ route('userprofile.update', $record->id) }} ">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>
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
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>
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
                    <label for="mobileno" class="col-md-4 control-label">Mobile Number</label>
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
                    <label for="username" class="col-md-4 control-label">UserName</label>
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
                    <label for="username" class="col-md-4 control-label">&nbsp;</label>
                    <div class="col-md-6">
                        <input id="changepwd" type="checkbox" name="changepwd" >Change Password
                    </div>
                </div>
                <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                    <label for="oldpassword" class="col-md-4 control-label">Old Password</label>
                    <div class="col-md-6">
                        <input id="oldpassword" type="password" class="form-control" placeholder="Enter Old Password" name="oldpassword" disabled required>
                        @if ($errors->has('oldpassword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('oldpassword') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>
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
                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" placeholder="Enter Confirm Password" name="password_confirmation" disabled required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="reset" class="btn btn-danger resetbtn">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="clearfix"></div>
@push('script')
<script type="text/javascript">
$(document).ready(function() {
$('#changepwd').removeAttr('checked');
$('#changepwd').click(function () {
//check if checkbox is checked
if ($(this).is(':checked')) {
$('#oldpassword').removeAttr('disabled'); //enable input
$('#password').removeAttr('disabled'); //enable input
$('#password-confirm').removeAttr('disabled'); //enable input
} else {
$('#oldpassword').attr('disabled', true); //disable input
$('#password').attr('disabled', true); //disable input
$('#password-confirm').attr('disabled', true); //disable input
}
});
});
</script>
@endpush
@endsection