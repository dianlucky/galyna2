<div class="row ps-lg-3 ps-sm-0">
    <h4 class="p-0">{{ $title }}</h4>
    <nav class="page-breadcrumb p-0">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}"
                    aria-current="{{ $loop->last ? 'page' : '' }}">
                    @if ($loop->last)
                        {{ $breadcrumb['name'] }}
                    @else
                        <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
</div>
