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
                        @if (isset($distributionAreaId) && $distributionAreaId)
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.analysisSeason.distribution-area-list', $distributionAreaId) }}" class="">@lang('custom_admin.label_distribution_area_list')</a></li>
                        @endif
                        @if (isset($distributionAreaId) && $distributionAreaId && isset($distributorId) && $distributorId)
                        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.analysisSeason.distributor-list', [$distributionAreaId, $distributorId]) }}" class="">@lang('custom_admin.label_distribution_area_list')</a></li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>