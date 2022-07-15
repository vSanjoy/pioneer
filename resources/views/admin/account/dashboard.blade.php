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

	@if(Auth::guard('admin')->user()->type == 'D' || Auth::guard('admin')->user()->type == 'S')
	<!-- ============================================================== -->
	<!-- Start Second Cards -->
	<!-- ============================================================== -->
	<div class="card-group">
		<div class="card border-right mr-3">
			<div class="card-body">
				<div class="row">
					@if(Auth::guard('admin')->user()->type == 'S')
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
									<a href="{{ route('admin.sellerAnalyses.distribution-area-list') }}" class="text-white">Analysis</a>
								</h2>
							</div>
						</div>
					</div>
					@endif
					<!-- Column -->
					<div class="col-md-6 col-lg-6 col-xlg-3">
						<div class="card card-hover">
							<div class="p-2 bg-success text-center">
								<h2 class="font-light text-white">
									<a href="" class="text-white">
										<i data-feather="shopping-bag" class="feather-icon"></i>
									</a>
								</h2>
								<h2 class="font-light text-white">
									<a href="" class="text-white">Order</a>
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
	
	<!-- ============================================================== -->
	<!-- Start Sales Charts Section -->
	<!-- ============================================================== -->
	{{-- <div class="row d-flex justify-container-center">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title mb-4">@lang('custom_admin.label_contacts_for_this_year')</h3>
					<canvas id="myChart" height="100"></canvas>
				</div>
			</div>
		</div>
	</div> --}}
	<!-- ============================================================== -->
	<!-- End Sales Charts Section -->
	<!-- ============================================================== -->

@endsection

{{-- @php
$contactMonths = '';
foreach ($months as $month) {
	if (array_key_exists($month, $contactGraph)) {
		$contactMonths .= $contactGraph[$month].',';
	} else {
		$contactMonths .= '0,';
	}
}
@endphp

@push('scripts')
<script>
	var ctx = document.getElementById('myChart');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
			datasets: [{
				label: '{!! $totalContact !!} of Contacts',
				data: [
					{!! $contactMonths !!}
					],
				backgroundColor: [
					'rgba(255, 99, 132, 0.5)',
					'rgba(54, 162, 235, 0.5)',
					'rgba(255, 206, 86, 0.5)',
					'rgba(75, 192, 192, 0.5)',
					'rgba(153, 102, 255, 0.5)',
					'rgba(255, 159, 64, 0.5)',
					'rgba(71, 204, 129, 0.5)',
					'rgba(199, 199, 52, 0.5)',
					'rgba(217, 67, 26, 0.5)',
					'rgba(75, 192, 192, 0.5)',
					'rgba(230, 11, 121, 0.5)',
					'rgba(10, 245, 194, 0.5)',
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
					'rgba(71, 204, 129, 1)',
					'rgba(199, 199, 52, 1)',
					'rgba(217, 67, 26, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(230, 11, 121, 1)',
					'rgba(10, 245, 194, 1)',
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
	</script>
@endpush --}}