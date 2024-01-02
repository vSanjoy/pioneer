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
                                            <option value="{{ $distributionArea->id }}">{{ $distributionArea->title }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">Beat<span class="red_star">*</span></label>
                                        <select class="selectpicker form-control" id="beat_id" name="beat_id" data-container="body" data-live-search="true" title="--@lang('custom_admin.label_select')--" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" required>
                                            <option value="">--@lang('custom_admin.label_select')--</option>
                                        @foreach ($beats as $itemBeat)
                                            <option value="{{ $itemBeat->id }}">{!! $itemBeat->title !!}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">Store<span class="red_star">*</span></label>
                                        <select class="selectpicker form-control" id="store_id" name="store_id" data-container="body" data-live-search="true" title="--@lang('custom_admin.label_select')--" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" required>
                                            <option value="">--@lang('custom_admin.label_select')--</option>
                                        @foreach ($stores as $itemStore)
                                            <option value="{{ $itemStore->id }}">{!! $itemStore->store_name !!} ({!! $itemStore->name_1.' - '.$itemStore->phone_no_1 !!})</option>
                                        @endforeach
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">@lang('custom_admin.label_payment_mode')</label>
                                        {{ Form::text('payment_mode', null, [
                                                            'id' => 'payment_mode',
                                                            'class' => 'form-control',
                                                            'placeholder' => ''
                                                            ]) }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">@lang('custom_admin.label_payment_details')</label>
                                        {{ Form::text('payment_details', null, [
                                                            'id' => 'payment_details',
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

@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush