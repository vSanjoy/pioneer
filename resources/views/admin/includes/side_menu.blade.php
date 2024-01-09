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

			<!-- Seller Management Start -->
			@php
			$sellerRoutes = ['seller.list','seller.add','seller.edit','seller.sort'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('seller.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $sellerRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $sellerRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="users" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_seller')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $sellerRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.seller.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('seller.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.seller.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
					</ul>
				</li>
			@endif

			<!-- Beat Management Start -->
			@php
			$beatRoutes = ['beat.list','beat.add','beat.edit','beat.sort'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('beat.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $beatRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $beatRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="map-pin" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_beat')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $beatRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.beat.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('beat.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.beat.add') }}" class="sidebar-link sub-menu">
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

			<li class="list-divider"></li>
			<li class="nav-small-cap"><span class="hide-menu">{{ __('custom_admin.label_analysis_order_report') }}</span></li>

			<!-- Area Analysis Management Start BLOCKED for new logic implementation -->
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

			<!-- Seller Analysis Management Start -->
			@php
			$sellerAnalysesRoutes = ['sellerAnalyses.distribution-area-list','sellerAnalyses.beat-list','sellerAnalyses.store-list','sellerAnalyses.category-list','sellerAnalyses.product-list','sellerAnalyses.analysis'];
			@endphp
			@if ( \Auth::guard('admin')->user()->type == 'S' || in_array('sellerAnalyses.distribution-area-list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $sellerAnalysesRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $sellerAnalysesRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="life-buoy" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_analysis')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $sellerAnalysesRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.sellerAnalyses.distribution-area-list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
					</ul>
				</li>
			@endif

			<!-- Order Management Start -->
			@php
			$orderRoutes = ['order.list'];
			@endphp
			{{-- @if ( ($isSuperAdmin) || \Auth::guard('admin')->user()->type != 'S' || in_array('order.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $orderRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $orderRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="shopping-bag" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_order')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $orderRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.order.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
					</ul>
				</li>
			@endif --}}

			<!-- Single Step Order Management Start -->
			@php
			$singleStepOrderRoutes = ['singleStepOrder.list', 'singleStepOrder.view', 'singleStepOrder.edit'];
			@endphp
			@if ( ($isSuperAdmin) || \Auth::guard('admin')->user()->type != 'S' || in_array('singleStepOrder.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $singleStepOrderRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $singleStepOrderRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="shopping-bag" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_single_step_order')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $singleStepOrderRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.singleStepOrder.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
					</ul>
				</li>
			@endif

			<!-- Report Management Start -->
			@php
			$analysisReportRoutes 	= ['analysisReport.list','sellerAnalyses.export'];
			$areaReportRoutes 		= ['areaReport.list'];
			$storeReportRoutes 		= ['storeReport.list'];
			@endphp
			@if ( ($isSuperAdmin) || \Auth::guard('admin')->user()->type == 'SA' )
				<li class="sidebar-item @if (in_array($currentPage, $analysisReportRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $analysisReportRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="bar-chart-2" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_report')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $analysisReportRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.analysisReport.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_menu_analysis') @lang('custom_admin.label_menu_report')</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="{{ route('admin.areaReport.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_menu_area') @lang('custom_admin.label_menu_report')</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="{{ route('admin.storeReport.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_menu_store') @lang('custom_admin.label_menu_report')</span>
							</a>
						</li>
					</ul>
				</li>
			@endif


			<li class="list-divider"></li>
			<li class="nav-small-cap"><span class="hide-menu">{{ __('custom_admin.label_payment_and_invoice') }}</span></li>

			<!-- Payment Management Start -->
			@php
			$paymentRoutes = ['payment.list', 'payment.collect','payment.add','payment.view', 'payment.edit'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('payment.collect', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $paymentRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $paymentRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="map-pin" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_payment')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $paymentRoutes))in @endif">
						@if ( (!$isSuperAdmin) || (in_array('payment.collect', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.payment.collect') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_collect')</span>
							</a>
						</li>
						@endif
						@if ( ($isSuperAdmin) || (in_array('payment.history', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.payment.history') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_history')</span>
							</a>
						</li>
						@endif
						@if ( ($isSuperAdmin) || (in_array('payment.report', $getAllRoles)) )
						<!-- <li class="sidebar-item">
							<a href="{{ route('admin.payment.report') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_report')</span>
							</a>
						</li> -->
						@endif
					</ul>
				</li>
			@endif

			<!-- Invoice Management Start -->
			@php
			$invoiceRoutes = ['invoice.list'];
			@endphp
			{{-- @if ( ($isSuperAdmin) || in_array('invoice.list', $getAllRoles) ) --}}
				<!-- <li class="sidebar-item @if (in_array($currentPage, $invoiceRoutes))selected @endif"> 
					<a class="sidebar-link sidebar-link @if (in_array($currentPage, $invoiceRoutes))active @endif" href="{{ route('admin.invoice.list') }}" aria-expanded="false">
						<i data-feather="sliders" class="feather-icon"></i><span class="hide-menu">{{ __('custom_admin.label_invoice_menu') }}</span>
					</a>
				</li> -->
			{{-- @endif --}}

			<!-- Store Gradation Management Start -->
			@php
			$storeGradationRoutes = ['storeGradation.list', 'storeGradation.view', 'storeGradation.edit'];
			@endphp
			{{-- @if ( ($isSuperAdmin) || in_array('storeGradation.list', $getAllRoles) ) --}}
				<!-- <li class="sidebar-item @if (in_array($currentPage, $storeGradationRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $storeGradationRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="star" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_store_gradation')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $storeGradationRoutes))in @endif">
						{{-- @if ( ($isSuperAdmin) || (in_array('storeGradation.list', $getAllRoles)) ) --}}
						<li class="sidebar-item">
							<a href="{{ route('admin.storeGradation.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						{{-- @endif
						@if ( ($isSuperAdmin) || (in_array('storeGradation.report', $getAllRoles)) ) --}}
						<li class="sidebar-item">
							<a href="{{ route('admin.storeGradation.report') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_report')</span>
							</a>
						</li>
						{{-- @endif --}}
					</ul>
				</li> -->
			{{-- @endif --}}

			
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