@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="row mb-4">
		<div class="col-lg-9 align-self-center">
			<h3 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ dayParts() }} {{ \Auth::guard('admin')->user()->first_name }}!</h3>
			<div class="d-flex align-items-center">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb m-0 p-0">
						<li class="breadcrumb-item">@lang('custom_admin.label_dashboard')</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="col-lg-3 align-self-center">
			<div class="customize-input float-right">
				<span class="custom-select-set-date-time form-control bg-white border-0 custom-shadow custom-radius">{{ getCurrentDate() }}</span>
				</select>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Start First Cards -->
	<!-- ============================================================== -->
	<div class="card-group mb-5">
		<div class="card border-right">
			<div class="card-body">
				<div class="d-flex d-lg-flex d-md-block align-items-center justfy-content-center">
					<div>
						<div class="d-inline-flex align-items-center">
							<h2 class="text-dark mb-1 font-weight-medium text-centre">
								{!! trans('custom_admin.message_welcome_to_admin_panel', [ 'websiteTitle' => $websiteSettings->website_title ]) !!}
							</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End First Cards -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->

	@if(Auth::guard('admin')->user()->type == 'SA')
	<!-- ============================================================== -->
	<!-- Start Second Cards -->
	<!-- ============================================================== -->
	<div class="card-group">
		<div class="card border-right mr-3">
			<div class="card-body">
				<div class="d-flex d-lg-flex d-md-block align-items-center">
					<div>
						<div class="d-inline-flex align-items-center">
							<h2 class="text-dark mb-1 font-weight-medium">{{ $totalDistributionAreas }}</h2>
						</div>
						<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Distribution Areas</h6>
					</div>
					<div class="ml-auto mt-md-3 mt-lg-0">
						<span class="opacity-7 text-muted">
							<a href="{{ route('admin.distributionArea.list') }}" class="hover-dark"><i data-feather="map" class="feather-icon"></i></a>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="card border-right mr-3">
			<div class="card-body">
				<div class="d-flex d-lg-flex d-md-block align-items-center">
					<div>
						<h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{ $totalDistributors }}</h2>
						<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Distributors</h6>
					</div>
					<div class="ml-auto mt-md-3 mt-lg-0">
						<span class="opacity-7 text-muted">
							<a href="{{ route('admin.distributor.list') }}" class="hover-dark"><i data-feather="users" class="feather-icon"></i></a>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="card border-right mr-3">
			<div class="card-body">
				<div class="d-flex d-lg-flex d-md-block align-items-center">
					<div>
						<div class="d-inline-flex align-items-center">
							<h2 class="text-dark mb-1 font-weight-medium">{{ $totalSellers }}</h2>
						</div>
						<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Sellers</h6>
					</div>
					<div class="ml-auto mt-md-3 mt-lg-0">
						<span class="opacity-7 text-muted">
							<a href="{{ route('admin.seller.list') }}" class="hover-dark"><i data-feather="users" class="feather-icon"></i></a>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="d-flex d-lg-flex d-md-block align-items-center">
					<div>
						<h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{ $totalBeats }}</h2>
						<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Beats</h6>
					</div>
					<div class="ml-auto mt-md-3 mt-lg-0">
						<span class="opacity-7 text-muted">
							<a href="{{ route('admin.beat.list') }}" class="hover-dark"><i data-feather="map-pin" class="feather-icon"></i></a>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-group">
		<div class="card border-right mr-3">
			<div class="card-body">
				<div class="d-flex d-lg-flex d-md-block align-items-center">
					<div>
						<div class="d-inline-flex align-items-center">
							<h2 class="text-dark mb-1 font-weight-medium">{{ $totalStores }}</h2>
						</div>
						<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Stores</h6>
					</div>
					<div class="ml-auto mt-md-3 mt-lg-0">
						<span class="opacity-7 text-muted">
							<a href="{{ route('admin.store.list') }}" class="hover-dark"><i class="fa fa-university" aria-hidden="true" style="font-size: 23px;"></i></a>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="card border-right mr-3">
			<div class="card-body">
				<div class="d-flex d-lg-flex d-md-block align-items-center">
					<div>
						<h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{ $totalCategories }}</h2>
						<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Categories</h6>
					</div>
					<div class="ml-auto mt-md-3 mt-lg-0">
						<span class="opacity-7 text-muted">
							<a href="{{ route('admin.category.list') }}" class="hover-dark"><i data-feather="file-text" class="feather-icon"></i></a>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="card border-right mr-3">
			<div class="card-body">
				<div class="d-flex d-lg-flex d-md-block align-items-center">
					<div>
						<div class="d-inline-flex align-items-center">
							<h2 class="text-dark mb-1 font-weight-medium">{{ $totalProducts }}</h2>
						</div>
						<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Products</h6>
					</div>
					<div class="ml-auto mt-md-3 mt-lg-0">
						<span class="opacity-7 text-muted">
							<a href="{{ route('admin.product.list') }}" class="hover-dark"><i data-feather="command" class="feather-icon"></i></a>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="d-flex d-lg-flex d-md-block align-items-center">
					<div>
						<h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{ $totalOrders }}</h2>
						<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Orders</h6>
					</div>
					<div class="ml-auto mt-md-3 mt-lg-0">
						<span class="opacity-7 text-muted">
							<a href="{{ route('admin.order.list') }}" class="hover-dark"><i data-feather="shopping-bag" class="feather-icon"></i></a>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End Second Cards -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	@endif

	@if(Auth::guard('admin')->user()->type == 'S')
	<!-- ============================================================== -->
	<!-- Start Second Cards -->
	<!-- ============================================================== -->
	<div class="card-group">
		<div class="card border-right mr-3">
			<div class="card-body">
				<div class="row justify-content-center">
					<!-- Column -->
					<div class="col-md-6 col-lg-6 col-xlg-3">
						<div class="card card-hover">
							<div class="p-2 bg-primary text-center">
								<h2 class="font-light text-white">
									<a href="{{ route('admin.sellerAnalyses.distribution-area-list') }}" class="text-white">
										<i data-feather="life-buoy" class="feather-icon"></i>
									</a>
								</h2>
								<h2 class="font-light text-white">
									<a href="{{ route('admin.sellerAnalyses.distribution-area-list') }}" class="text-white">
										@lang('custom_admin.label_multi_step_analysis')
									</a>
								</h2>
							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-md-6 col-lg-6 col-xlg-3">
						<div class="card card-hover">
							<div class="p-2 bg-success text-center">
								<h2 class="font-light text-white">
									<a href="{{ route('admin.singleStepSellerAnalyses.distribution-area-list') }}" class="text-white">
										<i data-feather="life-buoy" class="feather-icon"></i>
									</a>
								</h2>
								<h2 class="font-light text-white">
									<a href="{{ route('admin.singleStepSellerAnalyses.distribution-area-list') }}" class="text-white">
										@lang('custom_admin.label_single_step_analysis')
									</a>
								</h2>
							</div>
						</div>
					</div>
					<!-- Column -->
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End Second Cards -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	@endif

	@if(Auth::guard('admin')->user()->type == 'D')
	<!-- ============================================================== -->
	<!-- Start Second Cards -->
	<!-- ============================================================== -->
	<div class="card-group">
		<div class="card border-right mr-3">
			<div class="card-body">
				<div class="row justify-content-center">
					<!-- Column -->
					<div class="col-md-6 col-lg-6 col-xlg-3">
						<div class="card card-hover">
							<div class="p-2 bg-primary text-center">
								<h2 class="font-light text-white">
									<a href="{{ route('admin.analysisSeason.list') }}" class="text-white">
										<i data-feather="life-buoy" class="feather-icon"></i>
									</a>
								</h2>
								<h2 class="font-light text-white">
									<a href="{{ route('admin.analysisSeason.list') }}" class="text-white">
										@lang('custom_admin.label_analysis_season')
									</a>
								</h2>
							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-md-6 col-lg-6 col-xlg-3">
						<div class="card card-hover">
							<div class="p-2 bg-success text-center">
								<h2 class="font-light text-white">
									<a href="{{ route('admin.order.list') }}" class="text-white">
										<i data-feather="shopping-bag" class="feather-icon"></i>
									</a>
								</h2>
								<h2 class="font-light text-white">
									<a href="{{ route('admin.order.list') }}" class="text-white">
										@lang('custom_admin.label_order')
									</a>
								</h2>
							</div>
						</div>
					</div>
					<!-- Column -->
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End Second Cards -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	@endif

@endsection
