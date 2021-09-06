@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Add Janamat</h3>
      <span class="pull-right"><a href="{{ route('janamat.index') }}" class="btn btn-warning">{!! VIEWLIST_ICON !!}</a></span>
    </div>
    <div class="box-body" x-data="handler()" x-init="defaultField()">
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

                <button type="button" class="btn btn-info mb-4" x-on:click="addNewField()" style="float: right">+ Add Answer</button>

                <div style="margin-top:50px">
                    <template x-for="(field,index) in fields" :key="index">
                        <div class="form-group">
                            <div class="d-flex flex-row">
                                <label class="control-label" for="answers" x-text="name+' '+(index+1)"></label>
                                <a x-on:click="removeField(index)" style="float: right; font-size:30px;cursor:pointer">&times;</a>
                            </div>    
                            <input type="text" class="form-control" name="answers[]" x-model="field.txt1"/>
                        </div>
                    </template>  
                </div>      
                <div class="form-group">
                    <button type="submit" class="btn btn-success" style="margin-top:20px">Submit</button>
                </div>
            </div>  
        </form>
    </div>
</div>

<script>
     function handler() {  
        return {
            fields:[],
            name:'Janamat Answers',
            addNewField() {
                this.fields.push({
                    txt1: '',
                });   
            },
            removeField(index) {
            this.fields.splice(index, 1);
            },    

            defaultField(){
                var abc=["cars","toys","abc"];
                abc.map((value)=>{
                    this.fields.push({
                        txt1: value,
                    }); 
                })
            }
        }
    }
</script>
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