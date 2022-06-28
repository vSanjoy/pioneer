@php
$getAllRoles = getUserRoleSpecificRoutes();
$isSuperAdmin = false;
if (\Auth::guard('admin')->user()->id == 1 || \Auth::guard('admin')->user()->type == 'SA') {
    $isSuperAdmin = true;
}

$currentPageMergeRoute = explode('admin.', Route::currentRouteName());
if (count($currentPageMergeRoute) > 0) {
    $currentPage = $currentPageMergeRoute[1];
} else {
    $currentPage = Route::currentRouteName();
}

// Get site settings data
$getSiteSettings = getSiteSettings();
@endphp

<aside class="left-sidebar" data-sidebarbg="skin6">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar" data-sidebarbg="skin6">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="sidebar-item @if ($currentPage == 'dashboard')selected @endif"> 
					<a class="sidebar-link sidebar-link @if ($currentPage == 'dashboard')active @endif" href="{{ route('admin.dashboard') }}" aria-expanded="false">
						<i data-feather="home" class="feather-icon"></i><span class="hide-menu">@lang('custom_admin.label_dashboard')</span>
					</a>
				</li>

				<li class="list-divider"></li>
				<li class="nav-small-cap"><span class="hide-menu">@lang('custom_admin.label_managements')</span></li>

			<!-- Distribution Area Management Start -->
			@php
			$distributionAreaRoutes = ['distributionArea.list','distributionArea.add','distributionArea.edit','distributionArea.sort'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('distributionArea.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $distributionAreaRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $distributionAreaRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="map" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_distribution_area')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $distributionAreaRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.distributionArea.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('distributionArea.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.distributionArea.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
						{{-- @if ( ($isSuperAdmin) || (in_array('distributionArea.sort', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.distributionArea.sort') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_sort')</span>
							</a>
						</li>
						@endif --}}
					</ul>
				</li>
			@endif

			<!-- Distributor Management Start -->
			@php
			$distributorRoutes = ['distributor.list','distributor.add','distributor.edit','distributor.sort'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('distributor.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $distributorRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $distributorRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="users" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_distributor')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $distributorRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.distributor.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('distributor.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.distributor.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
					</ul>
				</li>
			@endif

			<!-- Store Management Start -->
			@php
			$storeRoutes = ['store.list','store.add','store.edit','store.sort'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('store.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $storeRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $storeRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i class="fa fa-university" aria-hidden="true" style="font-size: 20px;"></i><span class="hide-menu"> @lang('custom_admin.label_menu_store')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $storeRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.store.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('store.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.store.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
					</ul>
				</li>
			@endif

			<!-- Category Management Start -->
			@php
			$categoryRoutes = ['category.list','category.add','category.edit','category.sort'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('category.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $categoryRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $categoryRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="file-text" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_category')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $categoryRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.category.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('category.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.category.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
					</ul>
				</li>
			@endif

			<!-- Product Management Start -->
			@php
			$productRoutes = ['product.list','product.add','product.edit','product.sort'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('product.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $productRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $productRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="command" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_product')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $productRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.product.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('product.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.product.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
					</ul>
				</li>
			@endif

			<!-- Area Analysis Management Start -->
			{{-- @php
			$areaAnalysisRoutes = ['areaAnalysis.list','areaAnalysis.add','areaAnalysis.edit','areaAnalysis.sort','areaAnalysis.details-list'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('areaAnalysis.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $areaAnalysisRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $areaAnalysisRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="life-buoy" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_area_analysis')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $areaAnalysisRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.areaAnalysis.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('areaAnalysis.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.areaAnalysis.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
					</ul>
				</li>
			@endif --}}

			<!-- Analysis Management Start -->
			@php
			$analysesRoutes = ['analyses.list','analyses.details-list','analyses.details-add','analyses.details-edit'];
			@endphp
			@if ( in_array('analyses.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $analysesRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $analysesRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="life-buoy" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_analyses')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $analysesRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.analyses.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
					</ul>
				</li>
			@endif

			<!-- Season Management Start -->
			@php
			$analysisSeasonRoutes = ['analysisSeason.list','analysisSeason.add','analysisSeason.edit','analysisSeason.distribution-area-list','analysisSeason.distributor-list','analysisSeason.store-list','analysisSeason.analysis'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('analysisSeason.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $analysisSeasonRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $analysisSeasonRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="life-buoy" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_analysis_season')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $analysisSeasonRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.analysisSeason.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('analysisSeason.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.analysisSeason.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
					</ul>
				</li>
			@endif

			<!-- Website Settings Management Start -->
			{{-- @php
			$siteSettingRoutes 	= ['website-settings'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('website-settings', $getAllRoles) )
				<li class="list-divider"></li>
				<li class="nav-small-cap"><span class="hide-menu">@lang('custom_admin.label_miscellaneous')</span></li>

				@if ( ($isSuperAdmin) || (in_array('website-settings', $getAllRoles)) )
				<li class="sidebar-item @if (in_array($currentPage, $siteSettingRoutes))selected @endif"> 
					<a class="sidebar-link sidebar-link @if (in_array($currentPage, $siteSettingRoutes))active @endif" href="{{ route('admin.website-settings') }}" aria-expanded="false">
						<i data-feather="settings" class="feather-icon"></i><span class="hide-menu">@lang('custom_admin.label_website_settings')</span>
					</a>
				</li>
				@endif
			@endif --}}

				<li class="list-divider"></li>
				<li class="sidebar-item">
					<a class="sidebar-link sidebar-link" href="{{ route('admin.logout') }}" aria-expanded="false">
						<i data-feather="log-out" class="feather-icon"></i><span class="hide-menu">@lang('custom_admin.label_signout')</span>
					</a>
				</li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>