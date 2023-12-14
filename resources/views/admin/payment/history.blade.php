@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')
	<style type="text/css">
/*	.table th, .table td {border: none;}*/
	</style>

	<div class="row">
		<div class="col-12">
            <div class="card">
            	<div class="card-body">
	                <div class="row mt-1">
						<div class="col-md-4">
							<div class="form-group" id="">
								<label class="text-dark font-bold">@lang('custom_admin.label_store')<span class="red_star">*</span></label>
								<select name="" id="" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true" required>
									<option value="">--@lang('custom_admin.label_select')--</option>
							@if ($stores)
								@foreach ($stores as $key => $itemStore)
									@if ($key <= 4)
									<option value="{{ $itemStore->id }}" @if($itemStore->id == 25)selected @endif>{!! $itemStore->store_name !!}</option>
									@endif
								@endforeach
							@endif
								</select>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
	</div>

	<div class="row">
		<div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('custom_admin.label_date') }}</th>
                                <th scope="col">{{ __('custom_admin.label_amount') }}</th>
                                <th scope="col">{{ __('custom_admin.label_reference_no') }}</th>
                                <th scope="col">{{ __('custom_admin.label_note') }}</th>
                                <th scope="col">{{ __('custom_admin.label_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2023-11-24</td>
                                <td>15000.00</td>
                                <td>8963</td>
                                <td>Lorem Ipsum is dummy text</td>
                                <td>
                                    <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2023-11-22</td>
                                <td>6000.00</td>
                                <td>8962</td>
                                <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                <td>
                                    <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2023-11-14</td>
                                <td>2000.00</td>
                                <td>NA</td>
                                <td>NA</td>
                                <td>
                                    <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2023-11-10</td>
                                <td>3000.00</td>
                                <td>8961</td>
                                <td>Lorem Ipsum is simply dummy text</td>
                                <td>
                                    <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2023-11-04</td>
                                <td>10000.00</td>
                                <td>8960</td>
                                <td>Lorem Ipsum is simply dummy text</td>
                                <td>
                                    <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2023-11-01</td>
                                <td>500.00</td>
                                <td>8959</td>
                                <td>NA</td>
                                <td>
                                    <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>

    <!-- Edit Payment modal content -->
    <div id="edit-payment-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-dark">
                    <h4 class="modal-title" id="dark-header-modalLabel">{{ __('custom_admin.label_payment') }} - Academy (Krishandu pramanik)</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
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
                                <label class="text-dark font-bold">{{ __('custom_admin.label_amount') }}<span class="red_star">*</span></label>
                                {{ Form::number('amount', 15000.00, [
                                                            'id' => 'amount',
                                                            'min' => 0,
                                                            'class' => 'form-control',
                                                            'placeholder' => ''
                                                            ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-bold">{{ __('custom_admin.label_password') }}<span class="red_star">*</span></label>
                                {{ Form::text('password', null, [
                                                            'id' => 'password',
                                                            'class' => 'form-control',
                                                            'placeholder' => ''
                                                            ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-bold">{{ __('custom_admin.label_reference_no') }}</label>
                                {{ Form::text('reference', 8963, [
                                                            'id' => 'reference',
                                                            'class' => 'form-control',
                                                            'placeholder' => ''
                                                            ]) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-dark font-bold">{{ __('custom_admin.label_note') }}</label>
                                {{ Form::textarea('note', 'Lorem Ipsum is dummy text', [
                                                            'id' => 'note',
                                                            'class' => 'form-control',
                                                            'placeholder' => '',
                                                            'rows' => 3
                                                            ]) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-processing" class="btn btn-success btn-rounded"><i class="far fa-save" aria-hidden="true"></i> {{ __('custom_admin.btn_update') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
