@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Add Janamat</h3>
      <span class="pull-right"><a href="{{ route('janamat.index') }}" class="btn btn-warning">{!! VIEWLIST_ICON !!}</a></span>
    </div>
    <div class="box-body">
        <form method="POST" action="{{ route('janamat.store') }}" id="frm-post">
            {{ csrf_field() }}
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="control-label" for="question">Janamat Title <span class="text-danger">*</span></label>
                    <br>
                    <textarea id="my-editor" class="tinymce" name="question" placeholder="Place some text here" >{{ old('question') }}</textarea>
                    @error('question')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="control-label" for="answers">Janamat Answers</label>
                    <input type="text" class="form-control" name="answers" value="{{ old('answers') }}" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
           
        
        </form>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $('#frm-post').submit(function(event) {
        var checked = $("input[type=checkbox]:checked").length;
        if(!checked) {
            alert("You must check at least one checkbox.");
            return false;
        }
    });
</script>
@endpush
@endsection