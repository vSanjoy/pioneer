<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.dashboard') }}" class="">@lang('custom_admin.label_dashboard')</a></li>

                        {{-- Distribution area --}}
                        @if (isset($distributionAreaId) && !isset($beatId) && !isset($storeId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.sellerAnalyses.distribution-area-list') }}" class="">@lang('custom_admin.label_distribution_area_list')2222</a></li>
                        @elseif (isset($distributionAreaId) && isset($beatId) && !isset($storeId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.sellerAnalyses.distribution-area-list') }}" class="">@lang('custom_admin.label_distribution_area_list')444</a></li>
                        @endif

                        {{-- Beat --}}
                        @if (isset($distributionAreaId) && isset($beatId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.sellerAnalyses.beat-list', [$distributionAreaId]) }}" class="">@lang('custom_admin.label_beat_list') 3333</a></li>
                        @endif

                        {{-- Store --}}
                        {{-- @if (isset($distributionAreaId) && isset($beatId) && !isset($storeId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.sellerAnalyses.store-list', [$distributionAreaId, $beatId]) }}" class="">@lang('custom_admin.label_store_list') 444</a></li>
                        @endif --}}
                        
                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }} 101010</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>