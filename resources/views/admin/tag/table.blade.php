<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $page_header }}</h3>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-striped table-hover ui-sortable dataTablePagination">
            <thead>
                <tr class="nodrag nodrop">
                    <th>S.No</th>
                    <th>Title</th>
                    <th class="text-center">Link</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                @if(!empty($list))
                @foreach ($list as $item)
                <tr>
                    <td width='10px'>{{ $count++ }}</td>
                    <td>{{ str_limit($item->title, $limit = 50, $end = '...') }}</td>
                    <td class="text-center"><a href="{{ route('trending.list',$item->id) }}" target="_blank">{!! LINK_ICON !!}</a></td>
                    <td class="text-center">{!! getStatus($item->status) !!}</td>
                    <td class="text-center">
                        <a href="{{ route($link.'.edit', $item->id) }}"> {!! EDIT_ICON !!}</a>&nbsp;|
                        <a href="{{ route($link.'.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!} </a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>