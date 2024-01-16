@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')
	
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    {{ Form::open([
                        'method'=> 'POST',
                        'class' => '',
                        'route' => [$routePrefix.'.'.$addUrl.'-submit'],
                        'name'  => 'createCollectPaymentForm',
                        'id'    => 'createCollectPaymentForm',
                        'files' => true,
                        'novalidate' => true ]) }}
                            <input type="hidden" name="distribution_area" id="distribution_area" value="{{ $distributionArea->id }}">
                        <div class="form-body mt-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" id="distribution-area-div">
                                        <label class="text-dark font-bold">Distribution Area<span class="red_star">*</span></label>
                                        <select class="selectpicker form-control" id="distribution_area_id" name="distribution_area_id" data-container="body" disabled>
                                            <option value="{{ $distributionArea->id }}">{{ $distributionArea->title }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group" id="beat-div">
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
                                    <div class="form-group" id="store-div">
                                        <label class="text-dark font-bold">Store<span class="red_star">*</span></label>
                                        <select class="selectpicker form-control" id="store_id" name="store_id" data-container="body" data-live-search="true" title="--@lang('custom_admin.label_select')--" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" required>
                                            <option value="">--@lang('custom_admin.label_select')--</option>
                                        @foreach ($stores as $itemStore)
                                            @if ($itemStore->phone_no_1 != null)
                                                <option value="{{ $itemStore->id }}">{!! $itemStore->store_name !!} ({!! $itemStore->name_1.' - '.$itemStore->phone_no_1 !!})</option>
                                            @else
                                                <option value="{{ $itemStore->id }}">{!! $itemStore->store_name !!} ({!! $itemStore->name_1 !!})</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">@lang('custom_admin.label_date')<span class="red_star">*</span></label>
                                        {{ Form::text('date', null, [
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
                                        {{ Form::textarea('note', null, [
                                                            'id' => 'note',
                                                            'class' => 'form-control',
                                                            'placeholder' => '',
                                                            'rows' => 1
                                                            ]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
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

    <!-- List of collected payments -->
    <div class="row" id="collect-payment-history-list" style="display: none;">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Payment History</h4>
                    <div class="table-responsive">
                        <table id="list-table" class="table table-striped table-bordered no-wrap list-data custom-table custom-table-second-column">
                            <thead>
                                <th class="firstColumn">{{ __('custom_admin.label_hash') }}</th>
                                <th>{{ __('custom_admin.label_date') }}</th>
                                <th>{{ __('custom_admin.label_beat') }}</th>
                                <th>{{ __('custom_admin.label_store') }}</th>
                                <th>{{ __('custom_admin.label_owner') }}</th>
                                <th>{{ __('custom_admin.label_phone') }}</th>
                                <th>{{ __('custom_admin.label_amount') }}</th>
                                <th>{{ __('custom_admin.label_payment_mode') }}</th>
                                <!-- <th class="actions">{{ __('custom_admin.label_action') }}</th> -->
                            </thead>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush