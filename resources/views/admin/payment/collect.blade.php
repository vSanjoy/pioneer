@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')
	
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <form>
                        <div class="form-body mt-4-5">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">Distribution Area<span class="red_star">*</span></label>
                                        <select class="selectpicker form-control" id="distribution_area_id" name="distribution_area_id" data-container="body" disabled>
                                            <option value="1">MANKUNDU</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">Beat<span class="red_star">*</span></label>
                                        <select class="selectpicker form-control" id="distribution_area_ids" name="distribution_area_ids[]" data-container="body" data-live-search="true" title="--@lang('custom_admin.label_select')--" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" required>
                                            <option value="">--@lang('custom_admin.label_select')--</option>
                                            <option value="6" selected>Bandel</option>
                                            <option value="1">Bhadreswar</option>
                                            <option value="3">Chandannagar</option>
                                            <option value="5">Chinsurah</option>
                                            <option value="4">Hooghly</option>
                                            <option value="2">Mankundu jotir more</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">@lang('custom_admin.label_date')<span class="red_star">*</span></label>
                                        {{ Form::text('date_range', null, [
                                                            'id' => 'date',
                                                            'class' => 'form-control datePickerPayment',
                                                            'placeholder' => '',
                                                            'readonly' => true
                                                            ]) }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">@lang('custom_admin.label_amount')<span class="red_star">*</span></label>
                                        {{ Form::number('amount', null, [
                                                            'id' => 'amount',
                                                            'min' => 0,
                                                            'class' => 'form-control',
                                                            'placeholder' => ''
                                                            ]) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">@lang('custom_admin.label_reference_no')</label>
                                        {{ Form::text('reference', null, [
                                                            'id' => 'reference',
                                                            'class' => 'form-control',
                                                            'placeholder' => ''
                                                            ]) }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">@lang('custom_admin.label_note')</label>
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
                        <div class="form-actions mt-4">
                            <div class="float-left">
                                <a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="{{ route($routePrefix.'.payment.history') }}">
                                    <i class="far fa-arrow-alt-circle-left"></i> @lang('custom_admin.btn_cancel')
                                </a>
                            </div>
                            <div class="float-right">
                                <button type="submit" id="btn-processing" class="btn btn-primary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3">
                                    <i class="far fa-save" aria-hidden="true"></i> @lang('custom_admin.btn_submit')
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

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
