<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2>@yield('title')</h2>
            </div>
        </div>
        <!-- end col -->
        <div class="col-md-6">
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        @foreach($breadcrumbs as $item)
                            @if ($loop->last)
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $item['name'] }}
                                </li>
                            @else
                                @php $url = !empty($item['href']) ? $item['href'] : 'javascript:void(0);' @endphp
                                <li class="breadcrumb-item">
                                    <a href="{{ $url }}">{{ $item['name'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
