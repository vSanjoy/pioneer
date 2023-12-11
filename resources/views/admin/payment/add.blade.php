@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')
	<style type="text/css">
	.table th, .table td {border: none;}
	</style>

	@php $showStatus = 'style="display: block;"'; @endphp

	<!-- Start :: Filter -->
	<!-- <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form class="" id="showFilterStatus" {!! $showStatus !!}>
						<div class="form-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="text-dark font-bold">Date Range</label>
										{{ Form::text('date_range', null, [
																	'id' => 'date_range',
																	'class' => 'form-control dateRangePicker',
																	'placeholder' => '',
																	'readonly' => true
																	]) }}
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->
	<!-- End :: Filter -->

	<!-- <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="form-body">
						<div class="row">
							<div class="col-md-3">
									<div class="form-group" id="distribution-area-div">
										<label class="text-dark font-bold">Distributor<span class="red_star">*</span></label>
										<select name="distribution_area_id" id="distribution_area_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true" required>
											<option value="">--@lang('custom_admin.label_select')--</option>
										@if ($stores)
											@foreach ($stores as $itemStore)
											<option value="{{ $itemStore->id }}" @if ($itemStore->id == 5)selected @endif>{!! $itemStore->store_name !!}</option>
											@endforeach
										@endif
										</select>
									</div>
								</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="text-dark font-bold">Date<span class="red_star">*</span></label>
									{{ Form::text('date_range', null, [
																'id' => 'date',
																'class' => 'form-control datePickerPayment',
																'placeholder' => '',
																'readonly' => true
																]) }}
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="text-dark font-bold">Amount<span class="red_star">*</span></label>
									{{ Form::number('amount', null, [
																'id' => 'amount',
																'class' => 'form-control',
																'placeholder' => ''
																]) }}
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="text-dark font-bold">Ref. No.</label>
									{{ Form::text('reference', null, [
																'id' => 'reference',
																'class' => 'form-control',
																'placeholder' => ''
																]) }}
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="text-dark font-bold">Type<span class="red_star">*</span></label>
									<select class="form-control">
										<option value="cr">Credit</option>
										<option value="dr">Debit</option>
									</select>
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label class="text-dark font-bold">&nbsp;</label>
									<button type="submit" id="btn-processing" class="btn btn-primary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3 form-control">
										Save
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->

	<div class="row">
		<div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Store</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Name</th>
                                <th scope="col">Distribution Area</th>
                                <th scope="col">Beat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($stores)
							@foreach ($stores as $key => $itemStore)
							@if ($key <= 4)
							<tr>
                                <td>{!! $itemStore->store_name !!}</td>
                                <td>
								@if ($itemStore->phone_no_1 != NULL)
	                                {!! $itemStore->phone_no_1 !!}
	                            @else
	                                {!! 9876543210 !!}
                                @endif
                                </td>
                                <td>{!! $itemStore->name_1 !!}</td>
                                <td>
                                @if ($itemStore->distributionAreaDetails != NULL)
	                                {!! $itemStore->distributionAreaDetails->title !!}
	                            @else
	                                {!! 'N/A' !!}
                                @endif
                                </td>
                                <td>
	                            @if ($itemStore->beatDetails != NULL)
	                                {!! $itemStore->beatDetails->title !!}
	                            @else
	                                {!! 'N/A' !!}
                                @endif
                            	</td>
                                <td>
                                	<a href="javascript: void(0);" class="btn-rounded btn-light shadow-md pr-3 pl-3" style="padding: 0.375rem 0.75rem" data-toggle="modal" data-target="#dark-header-modal">Collect</a>
								</td>
                            </tr>
                            @endif
							@endforeach
						@endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>

	<!-- Center modal content -->
	<div id="dark-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-dark">
                    <h4 class="modal-title" id="dark-header-modalLabel">Collect Payment</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="text-dark font-bold">Date<span class="red_star">*</span></label>
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
								<label class="text-dark font-bold">Amount<span class="red_star">*</span></label>
								{{ Form::number('amount', null, [
															'id' => 'amount',
															'class' => 'form-control',
															'placeholder' => ''
															]) }}
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="text-dark font-bold">Ref. No.</label>
								{{ Form::text('reference', null, [
															'id' => 'reference',
															'class' => 'form-control',
															'placeholder' => ''
															]) }}
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="text-dark font-bold">Note</label>
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
                    <button type="submit" id="btn-processing" class="btn btn-dark btn-rounded">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Collect Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <h5>Overflowing text to show scroll behavior</h5>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio,
                        dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta
                        ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                        Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor
                        auctor.</p>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

	<!-- <div class="row">
		<div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Inv. No.</th>
                                <th scope="col">Ref. No.</th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th>
                                <th scope="col">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>04-11-2023</td>
                                <td>PS/04/11/2023/20066</td>
                                <td></td>
                                <td>60000.00</td>
                                <td>0.00</td>
                                <td>200000.00</td>
                            </tr>
                            <tr>
                                <td>06-11-2023</td>
                                <td>PS/06/11/2023/20067</td>
                                <td></td>
                                <td>5000.00</td>
                                <td>0.00</td>
                                <td>195000.00</td>
                            </tr>
                            <tr>
                                <td>07-11-2023</td>
                                <td>PS/07/11/2023/20068</td>
                                <td></td>
                                <td>7000.00</td>
                                <td>0.00</td>
                                <td>188000.00</td>
                            </tr>
                            <tr>
                                <td>08-11-2023</td>
                                <td>PS/08/11/2023/20069</td>
                                <td></td>
                                <td>100000.00</td>
                                <td>0.00</td>
                                <td>88000.00</td>
                            </tr>
                            <tr>
                                <td>09-11-2023</td>
                                <td>PS/09/11/2023/20070</td>
                                <td></td>
                                <td>18000.00</td>
                                <td>0.00</td>
                                <td>70000.00</td>
                            </tr>
                            <tr>
                                <td>10-11-2023</td>
                                <td>PS/10/11/2023/20071</td>
                                <td></td>
                                <td>30000.00</td>
                                <td>0.00</td>
                                <td>40000.00</td>
                            </tr>
                            <tr>
                                <td>11-11-2023</td>
                                <td></td>
                                <td>8690</td>
                                <td>0.00</td>
                                <td>20000.00</td>
                                <td>60000.00</td>
                            </tr>
                            <tr>
                                <td>12-11-2023</td>
                                <td>PS/12/11/2023/20072</td>
                                <td></td>
                                <td>30000.00</td>
                                <td>0.00</td>
                                <td>30000.00</td>
                            </tr>
                            <tr>
                                <td>13-11-2023</td>
                                <td>PS/13/11/2023/20073</td>
                                <td></td>
                                <td>10000.00</td>
                                <td>0.00</td>
                                <td>20000.00</td>
                            </tr>
                            <tr>
                                <td>14-11-2023</td>
                                <td>PS/14/11/2023/20074</td>
                                <td></td>
                                <td>5000.00</td>
                                <td>0.00</td>
                                <td>15000.00</td>
                            </tr>
                            <tr>
                                <td>15-11-2023</td>
                                <td>PS/15/11/2023/20075</td>
                                <td></td>
                                <td>5000.00</td>
                                <td>0.00</td>
                                <td>10000.00</td>
                            </tr>
                            <tr>
                                <td>18-11-2023</td>
                                <td></td>
                                <td>8691</td>
                                <td>0.00</td>
                                <td>2000.00</td>
                                <td>12000.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div> -->

@endsection
