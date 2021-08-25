@extends('admin.app')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ $page_header }}</h3>
      <span class="pull-right"><a href="{{ route($link.'.index') }}" class="btn btn-warning">{!! VIEWLIST_ICON !!}</a></span>
    </div>
    <div class="box-body">
        <form method="POST" action="{{ route($link.'.update', $record->id) }} ">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="control-label" for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $record->title }}" >
                    @error('title')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">Description <span class="text-danger">*</span></label>
                    <br>
                    <textarea id="my-editor" class="form-control tinymce" name="description" placeholder="Place some text here" >{{ $record->description }}</textarea>
                    @error('description')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="control-label" for="published_date">Published Date <span class="text-danger">*</span></label>
                    <input type="text" class="form-control datepicker" id="published_date" name="published_date" value="{{ $record->published_date }}">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="statusid" class="form-control">
                        <option value="1" @if($record->status == '1') {{ 'selected' }} @endif >{!! PUBLISH !!}</option>
                        <option value="0" @if($record->status == '0') {{ 'selected' }} @endif >{!! UNPUBLISH !!}</option>
                    </select>
                </div>
               <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-danger resetbtn">Clear</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">FAQ List</h3>
      <span class="pull-right"><a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#add-faq-list-modal">{!! ADD_ICON !!}</a></span>
    </div>
    <div class="box-body">
        <form method="POST" action="{{ route($linkx.'.store') }}">
            {{ csrf_field() }}
            <table id="sortable" class="table table-striped table-hover todo-list ui-sortable" >
                <tr class="nodrag nodrop">
                    <th><span class="handle"><i class="fa fa-arrows"></i></span></th>
                    <th>Title</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
                <?php $sort_orders = ''; ?>
                @foreach ($faqlist as $item)
                <?php $sort_orders .= $item->sort_order . ','; ?>
                <tr id="{{ $item->id }}">
                    <td width='10px' class="move">
                        <span class="handle">
                            <i class="fa fa-ellipsis-v"></i>
                            <i class="fa fa-ellipsis-v"></i>
                        </span>
                    </td>
                    <td>{{ $item->title }}</td>
                    <td width='50px' class="text-center" data-toggle="modal" data-target="#edit-faq-list-modal">{!! getStatus($item->status) !!}</td>
                    <td width='50px' class="text-center">
                        <a href="javascript:void(0)" onclick="showEditModal('{{ $item->id }}')"> {!! EDIT_ICON !!} </a> |
                        <a href="{{ route($linkx.'.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!} </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </form>
    </div>
</div>

{{-- add modal --}}
<div class="modal fade" id="add-faq-list-modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route($linkx.'.store') }}">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Faq List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <textarea class="form-control" name="title" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="statusid" class="form-control">
                            <option value="1">{!! PUBLISH !!}</option>
                            <option value="0">{!! UNPUBLISH !!}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="faq_id" value="{{ $record->id }}">
                    <button type="submit" class="btn btn-primary" id="btn-faq-list">Save Changes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="edit-faq-list-modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="edit-modal-content">
        </div>
    </div>
</div>

@push('script')
<script type="text/javascript">
    $('#sortable').tableDnD({
        onDrop: function (table, row) {
            $.post("{{ route('ajax.sorting') }}", {ids_order: $.tableDnD.serialize(), sort_orders: '<?php echo $sort_orders; ?>', table: 'tbl_faq_list', _token: '{!! csrf_token() !!}'});
        }
    });

    function showEditModal(id){
        var baseurl = "{{ url('/') }}";
        $.ajax({
            url: baseurl+'/u-admin/faqlist/'+id+'/edit',
        })
        .always(function(resp) {
            $('#edit-faq-list-modal').modal('show');
            $('#edit-modal-content').html(resp);
        });

    }
</script>
@endpush
@endsection