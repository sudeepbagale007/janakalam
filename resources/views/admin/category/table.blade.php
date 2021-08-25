<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $page_header }}</h3>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-hover table-condensed dataTable compact">
            <thead class="bg-primary">
                <tr>
                    <th>S.No</th>
                    <th>Ttile</th>
                    <th>Slug</th>
                    <th class="text-center">Link</th>
                    <th class="text-center">Template</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                @foreach ($list as $k => $item)
                <tr>
                    <td>{{ $count }}</td>
                    <td><b>{{ $item->title }}</b></td>
                    <td>{{ $item->slug }}</td>
                    <td class="text-center"><a href="{{ route($link.'.list',$item->slug) }}" target="_blank">{!! VIEW_ICON !!}</a> </td>
                    <td class="text-center">{{ $item->templatename }}</td>
                    <td class="text-center">{!! getStatus($item->status) !!}</td>
                    <td width="100px" class="text-center">
                        <a href="{{ route($link.'.edit', $item->id) }}">{!! EDIT_ICON !!} </a>&nbsp;|&nbsp;
                        <a href="{{ route($link.'.delete', $item->id) }}" class="resetbtn">{!! DELETE_ICON !!}</a>
                    </td>
                </tr>
                @if (!empty($item->childlist))
                @foreach ($item->childlist as $kl => $child)
                    <tr>
                        <td>{{ $count.'.'.($kl+1) }}</td>
                        <td>{{ $child->title }}</td>
                        <td>{{ $child->slug }}</td>
                        <td class="text-center"><a href="{{ route($link.'.list',$child->slug) }}" target="_blank">{!! VIEW_ICON !!}</a> </td>
                        <td class="text-center">{{ $child->templatename }}</td>
                        <td class="text-center">{!! getStatus($child->status) !!}</td>
                        <td width="100px" class="text-center">
                            <a href="{{ route($link.'.edit', $child->id) }}">{!! EDIT_ICON !!} </a>&nbsp;|&nbsp;
                            <a href="{{ route($link.'.delete', $child->id) }}" class="resetbtn">{!! DELETE_ICON !!}</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                <?php $count++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>