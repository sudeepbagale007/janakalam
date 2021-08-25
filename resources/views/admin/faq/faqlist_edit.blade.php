<form method="POST" action="{{ route($linkx.'.update',$record->id) }}">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Edit Faq List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="title">Title</label>
            <textarea class="form-control" name="title" rows="4" required>{!! $record->title !!}</textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="statusid" class="form-control">
                <option value="1" @if($record->status == '1') {{ 'selected' }} @endif >{!! PUBLISH !!}</option>
                <option value="0" @if($record->status == '0') {{ 'selected' }} @endif >{!! UNPUBLISH !!}</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="faq_id" value="{{ $record->id }}">
        <button type="submit" class="btn btn-primary" id="btn-faq-list">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>