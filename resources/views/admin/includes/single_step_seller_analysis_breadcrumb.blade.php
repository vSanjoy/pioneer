<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        {{-- Distribution area --}}
                        @if (isset($distributionAreaId) && !isset($beatId) && !isset($storeId) && !isset($categoryId) && !isset($productId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.singleStepSellerAnalyses.distribution-area-list') }}" class="">@lang('custom_admin.label_distribution_area_list')</a></li>
                        @elseif (isset($distributionAreaId) && isset($beatId) && !isset($storeId) && !isset($categoryId) && !isset($productId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.singleStepSellerAnalyses.distribution-area-list') }}" class="">@lang('custom_admin.label_distribution_area_list')</a></li>
                        @elseif (isset($distributionAreaId) && isset($beatId) && isset($storeId) && !isset($categoryId) && !isset($productId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.singleStepSellerAnalyses.distribution-area-list') }}" class="">@lang('custom_admin.label_distribution_area_list')</a></li>
                        @elseif (isset($distributionAreaId) && isset($beatId) && isset($storeId) && isset($categoryId) && !isset($productId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.singleStepSellerAnalyses.distribution-area-list') }}" class="">@lang('custom_admin.label_distribution_area_list')</a></li>
                        @elseif (isset($distributionAreaId) && isset($beatId) && isset($storeId) && isset($categoryId) && isset($productId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.singleStepSellerAnalyses.distribution-area-list') }}" class="">@lang('custom_admin.label_distribution_area_list')</a></li>
                        @endif

                        {{-- Beat --}}
                        @if (isset($distributionAreaId) && isset($beatId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.singleStepSellerAnalyses.beat-list', [$distributionAreaId]) }}" class="">@lang('custom_admin.label_beat_list')</a></li>
                        @endif

                        {{-- Store --}}
                        @if (isset($distributionAreaId) && isset($beatId) && isset($storeId) && !isset($categoryId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.singleStepSellerAnalyses.store-list', [$distributionAreaId, $beatId]) }}" class="">@lang('custom_admin.label_store_list')</a></li>
                        @elseif (isset($distributionAreaId) && isset($beatId) && isset($storeId) && isset($categoryId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.singleStepSellerAnalyses.store-list', [$distributionAreaId, $beatId]) }}" class="">@lang('custom_admin.label_store_list')</a></li>
                        @endif

                        {{-- Season --}}
                        @if (isset($distributionAreaId) && isset($beatId) && isset($storeId) && isset($analysisSeasonId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.singleStepSellerAnalyses.season-list', [$distributionAreaId, $beatId, $storeId]) }}" class="">@lang('custom_admin.label_season_list')</a></li>
                        @elseif (isset($distributionAreaId) && isset($beatId) && isset($storeId) && isset($seasonId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.singleStepSellerAnalyses.season-list', [$distributionAreaId, $beatId, $storeId]) }}" class="">@lang('custom_admin.label_season_list')</a></li>
                        @endif

                        {{-- Distributor --}}
                        @if (isset($distributionAreaId) && isset($beatId) && isset($storeId) && isset($seasonId) && isset($distributorId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.singleStepSellerAnalyses.distributor-list', [$distributionAreaId, $beatId, $storeId, $seasonId]) }}" class="">@lang('custom_admin.label_distributor_list')</a></li>
                        @elseif (isset($distributionAreaId) && isset($beatId) && isset($storeId) && isset($seasonId))
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.singleStepSellerAnalyses.distributor-list', [$distributionAreaId, $beatId, $storeId, $seasonId]) }}" class="">@lang('custom_admin.label_distributor_list')</a></li>
                        @endif

                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>