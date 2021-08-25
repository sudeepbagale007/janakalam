<section id="vcBreadcrumb" class="breadcrumbWrap">
    <div class="breadCrumbInfo text-center">
        <div class="container">
            @if (count($breadcrumbs))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach ($breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    @endif
                    @endforeach
                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
                </ol>
            </nav>
            @endif
        </div>
    </div>
</section>