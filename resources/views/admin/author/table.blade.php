<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $page_header }}</h3>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-hover table-condensed dataTable compact">
            <thead class="bg-primary">
                <tr>
                    <th width="50px">S.No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                @foreach ($list as $k => $item)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td width="50px" class="text-center">{!! getStatus($item->status) !!}</td>
                    <td width="100px" class="text-center">
                        <a href="{{ route($link.'.edit', $item->id) }}">{!! EDIT_ICON !!} </a>&nbsp;|&nbsp;
                        <a href="{{ route($link.'.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>