<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.dashboard') }}" class="">@lang('custom_admin.label_dashboard')</a></li>
                        @if ($analysisSeasonId)
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.analysisSeason.list') }}" class="">@lang('custom_admin.label_analysis_season_list')</a></li>
                        @endif
                        {{-- Distribution area --}}
                        @if (!isset($distributionAreaId) && !isset($distributorId) && !isset($storeId))
                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                        @elseif (isset($distributionAreaId) && !isset($distributorId) && !isset($storeId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.analysisSeason.distribution-area-list', [$analysisSeasonId]) }}" class="">@lang('custom_admin.label_distribution_area_list')</a></li>
                        @elseif (isset($distributionAreaId) && isset($distributorId) && !isset($storeId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.analysisSeason.distribution-area-list', [$analysisSeasonId]) }}" class="">@lang('custom_admin.label_distribution_area_list')</a></li>
                        @elseif (isset($distributionAreaId) && isset($distributorId) && isset($storeId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.analysisSeason.distribution-area-list', [$analysisSeasonId]) }}" class="">@lang('custom_admin.label_distribution_area_list')</a></li>
                        @endif

                        {{-- Distributor --}}
                        @if (isset($distributionAreaId) && !isset($distributorId))
                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                        @elseif (isset($distributionAreaId) && isset($distributorId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.analysisSeason.distributor-list', [$analysisSeasonId, $distributionAreaId]) }}" class="">@lang('custom_admin.label_distributor_list')</a></li>
                        @endif

                        {{-- Store --}}
                        @if (isset($distributionAreaId) && isset($distributorId) && !isset($storeId))
                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                        @elseif (isset($distributionAreaId) && isset($distributorId) && isset($storeId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.analysisSeason.store-list', [$analysisSeasonId, $distributionAreaId, $distributorId]) }}" class="">@lang('custom_admin.label_store_list')</a></li>
                        @endif

                        {{-- Analysis --}}
                        @if (isset($id))
                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>