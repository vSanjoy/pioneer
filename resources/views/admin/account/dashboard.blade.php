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
										@lang('custom_admin.label_analysis')
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
