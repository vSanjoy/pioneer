@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<style type="text/css">
	.actions {pointer-events: none !important;}
	</style>

	@php
	$storeId = '121';
	$hideStatus = 'style="display: none;"';
	$showStatus = 'style="display: block;"';
	if (isset($_GET['store_id']) && $_GET['store_id'] != '') { $storeId = $_GET['store_id']; }
	
	if ( (isset($_GET['store_id']) && $_GET['store_id'] != '') ) {
		$showStatus = 'style="display: block;"';
		$hideStatus = 'style="display: none;"';
	}
	@endphp

	<!-- Start :: Filter -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Filter</h4>
					<button type="button" class="btn search-toggle-icon" id="toggleSearchBox">
						<i class="fas fa-plus" id="plus" data-ctoggle="1" {!! $hideStatus !!}></i>
						<i class="fas fa-minus" id="minus" data-ctoggle="0" {!! $showStatus !!}></i>
					</button>
					<form class="mt-4" id="showFilterStatus" {!! $showStatus !!}>
						<div class="form-body">
							<div class="row">

								{{-- Start :: Distribution Area --}}
								<div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">Distribution Area</label>
                                        <select class="selectpicker form-control" id="distribution_area_id" name="distribution_area_id" data-container="body" disabled>
                                            <option value="1">MANKUNDU</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- End :: Distribution Area --}}

								{{-- Start :: Beat --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">{{ __('custom_admin.label_beat') }}</label>
                                        <select name="store_id" id="store_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
                                            <option value="">--@lang('custom_admin.label_select')--</option>
                                            <option value="6" selected>Bandel</option>
                                            <option value="1">Bhadreswar</option>
                                            <option value="2">Mankundu jotir more</option>
                                            <option value="3">Chandannagar</option>
                                            <option value="4">Hooghly</option>
                                            <option value="5">Chinsurah</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- End :: Beat --}}

								{{-- Start :: Store --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">{{ __('custom_admin.label_store') }}</label>
                                        <select name="store_id" id="store_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
                                            <option value="">--@lang('custom_admin.label_select')--</option>
                                            <option value="1" selected>SARAT STORES (SHIBLAL SARKAR - 9231879588)</option>
                                            <option value="2">JAISWAL (SURESH JAISWAL - 9830366115)</option>
                                            <option value="3">SARKAR ENTERPRISE (SANJOY SARKAR - 9874160892)</option>
                                            <option value="4">RAJENDRA XEROX (PRANAB BISWAS - 8013218899)</option>
                                            <option value="5">ROY ENTERPRISE (SHISIR ROY - 9836530815)</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- End :: Store --}}
								
								<div class="col-md-4">
									<div class="form-group">
										<label class="text-dark font-bold">&nbsp;</label><br />
										{{-- <button class="btn btn-info btn-circle btn-circle-sm filterList" type="button" title="Filter">
											<i class="fas fa-search"></i>
										</button> --}}
										<button class="btn btn-dark btn-circle btn-circle-sm resetFilter" type="button" title="Reset">
											<i class="fas fa-sync-alt ml_minus_1" aria-hidden="true"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End :: Filter -->

	<!-- <table id="list-table" class="table table-striped table-bordered no-wrap list-data custom-table custom-table-second-column">
							<thead>
								<tr>
									<th class="zeroColumn table-th-display-none"></th>
									<th class="firstColumn">@lang('custom_admin.label_hash')</th>
									<th class="modifiedColumn">@lang('custom_admin.label_date')</th>
									<th class="modifiedColumn">Inv. No.</th>
									<th class="modifiedColumn">Ref. No.</th>
									<th class="modifiedColumn">@lang('custom_admin.label_store')</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Balance</th>
								</tr>
							</thead>
						</table> -->

	<!-- <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">
						{{ $pageTitle }}

						<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3 float-right" href="javascript: void(0);" data-toggle="modal" data-target="#collect-grade-modal">
							<i class="fa fa-plus-circle"></i> {{ __('custom_admin.label_add_grade') }}
						</a>
					</h4>
					<div class="table-responsive mt-4-5">
						<table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                	<th class="firstColumn">{{ __('custom_admin.label_hash') }}</th>
                                    <th>{{ __('custom_admin.label_store') }}</th>
                                    <th>{{ __('custom_admin.label_owner') }}</th>
                                    <th>{{ __('custom_admin.label_phone') }}</th>
                                    <th>{{ __('custom_admin.label_distribution_area') }}</th>
                                    <th>{{ __('custom_admin.label_beat') }}</th>
                                    <th class="actions">{{ __('custom_admin.label_average_grade') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>SARAT STORES</td>
                                    <td>SHIBLAL SARKAR</td>
                                    <td>9231879588</td>
                                    <td>MANKUNDU</td>
                                    <td>Bandel</td>
                                    <td>4.4</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>APANJAN</td>
                                    <td>AJAY</td>
                                    <td>9932868725</td>
                                    <td>Arambagh</td>
                                    <td>Katulpur</td>
                                    <td>3.1</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>BIDYAMANDIR NABADWIP</td>
                                    <td>AJAY</td>
                                    <td>9932868725</td>
                                    <td>Kalna</td>
                                    <td>Nabadwip</td>
                                    <td>2.5</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Moden Stationary</td>
                                    <td>Suman Sur</td>
                                    <td>9800120623</td>
                                    <td>Barasat</td>
                                    <td>Habra</td>
                                    <td>3.5</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Trapti Stores</td>
                                    <td>Surojit Das</td>
                                    <td>9832710097</td>
                                    <td>Barasat</td>
                                    <td>Habra</td>
                                    <td>4.2</td>
                                </tr>
                            </tbody>
                        </table>
                        
					</div>
				</div>
			</div>
		</div>
	</div> -->

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">
						{{ $pageTitle }}

						<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3 float-right" href="javascript: void(0);" data-toggle="modal" data-target="#collect-grade-modal">
							<i class="fa fa-plus-circle"></i> {{ __('custom_admin.label_add_grade') }}
						</a>
					</h4>
					<div class="table-responsive mt-4-5">
						<table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                	<th class="firstColumn">{{ __('custom_admin.label_hash') }}</th>
                                    <th>{{ __('custom_admin.label_store') }}</th>
                                    <th>{{ __('custom_admin.label_owner') }}</th>
                                    <th>{{ __('custom_admin.label_phone') }}</th>
                                    <th>{{ __('custom_admin.label_distribution_area') }}</th>
                                    <th>{{ __('custom_admin.label_beat') }}</th>
                                    <th class="actions">{{ __('custom_admin.label_average_grade') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>SARAT STORES</td>
                                    <td>SHIBLAL SARKAR</td>
                                    <td>9231879588</td>
                                    <td>MANKUNDU</td>
                                    <td>Bandel</td>
                                    <td>4.4</td>
                                </tr>
                            </tbody>
                        </table>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Collect Payment modal content -->
	<div id="collect-grade-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-dark">
                    <h4 class="modal-title" id="dark-header-modalLabel">{{ __('custom_admin.label_grade') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    	{{-- Start :: Beat --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-dark font-bold">{{ __('custom_admin.label_beat') }}</label>
                                <select name="store_id" id="store_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
                                    <option value="">--@lang('custom_admin.label_select')--</option>
                                    <option value="6" selected>Bandel</option>
                                    <option value="1">Bhadreswar</option>
                                    <option value="2">Mankundu jotir more</option>
                                    <option value="3">Chandannagar</option>
                                    <option value="4">Hooghly</option>
                                    <option value="5">Chinsurah</option>
                                </select>
                            </div>
                        </div>
                        {{-- End :: Beat --}}

                        {{-- Start :: Store --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-dark font-bold">Store<span class="red_star">*</span></label>
                                <select class="selectpicker form-control" id="distribution_area_ids" name="distribution_area_ids[]" data-container="body" data-live-search="true" title="--@lang('custom_admin.label_select')--" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" required>
                                    <option value="">--@lang('custom_admin.label_select')--</option>
                                    <option value="1" selected>SARAT STORES (SHIBLAL SARKAR - 9231879588)</option>
                                    <option value="2">JAISWAL (SURESH JAISWAL - 9830366115)</option>
                                    <option value="3">SARKAR ENTERPRISE (SANJOY SARKAR - 9874160892)</option>
                                    <option value="4">RAJENDRA XEROX (PRANAB BISWAS - 8013218899)</option>
                                    <option value="5">ROY ENTERPRISE (SHISIR ROY - 9836530815)</option>
                                </select>
                            </div>
                        </div>
                        {{-- End :: Store --}}

                    	<div class="col-md-6">
							<div class="form-group">
								<label class="text-dark font-bold">{{ __('custom_admin.label_date') }}<span class="red_star">*</span></label>
								{{ Form::text('date_range', null, [
															'id' => 'date',
															'class' => 'form-control datePickerPayment',
															'placeholder' => '',
															'readonly' => true
															]) }}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="text-dark font-bold">{{ __('custom_admin.label_grade') }}<span class="red_star">*</span></label>
								{{ Form::number('grade', null, [
															'id' => 'grade',
															'min' => 0,
															'class' => 'form-control',
															'placeholder' => ''
															]) }}
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="text-dark font-bold">{{ __('custom_admin.label_note') }}</label>
								{{ Form::textarea('reference', null, [
															'id' => 'reference',
															'class' => 'form-control',
															'placeholder' => '',
															'rows' => 3
															]) }}
							</div>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-processing" class="btn btn-success btn-rounded"><i class="far fa-save" aria-hidden="true"></i> {{ __('custom_admin.label_save') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function () {
    $(".actions").removeClass("sorting");
});
$(document).on('click', '#toggleSearchBox', function() {
	if ($('#showFilterStatus').is(':visible')) {
		$('#plus').show();
		$('#minus').hide();	
	} else {
		$('#minus').show();
		$('#plus').hide();
	}
	$('#showFilterStatus').toggle(400);
});
</script>
@endpush