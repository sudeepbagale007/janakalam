<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $page_header }}</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-condensed dataTable">
                <thead class="bg-primary">
                    <tr>
                        <th>S.No</th>
                        <th>Ttile</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @foreach ($list as $item)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description }}</td>
                        <td class="center-align">{!! getStatus($item->status) !!}</td>
                        <td width="100px" class="center-align">
                            <a href="{{ route('usergroup.edit', $item->id) }}">{!! EDIT_ICON !!} </a> |
                            <a href="{{ route('usergroup.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>