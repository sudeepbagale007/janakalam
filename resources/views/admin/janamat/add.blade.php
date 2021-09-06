@extends('admin.app')
@section('content')
<style>
    .hide{
        display: none;
    }

    .show{
        display: block
    }
</style>
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
                    <input type="hidden" value="{{$id}}" name="id"/>
                    <label class="control-label" for="question">Janamat Title <span class="text-danger">*</span></label>
                    <br>
                    <textarea id="my-editor" class="tinymce" name="question" placeholder="Place some text here" >@if($id==null){{ old('question') }} @else {{$data->question}} @endif</textarea>
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
                                <a x-on:click="removeField(index)" style="float: right; font-size:30px;cursor:pointer" :class="fields.length==1?'hide':'show'">&times;</a>
                            </div>    
                            <input type="text" class="form-control" name="answers[]" x-model="field.txt1" required/>

                            @error('answers.*')
                                <div class="text-danger error">{{ $message }}</div>
                            @enderror
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
                
                var answer='<?=$data->answers;?>';
                var abc=answer.split(',');
                abc.map((value)=>{
                    this.fields.push({
                        txt1: value,
                    }); 
                });                               
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