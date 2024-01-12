@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

    <style type="text/css">
    .actions {pointer-events: none !important;}
    </style>

    @php
    $dateRange = ''; $beatId = $storeId = '';
    $hideStatus = 'style="display: none;"';
    $showStatus = 'style="display: block;"';
    $listSection = 'style="display: none;"';
    if (isset($_GET['date_range']) && $_GET['date_range'] != '') { $dateRange = $_GET['date_range']; }
    if (isset($_GET['beat_id']) && $_GET['beat_id'] != '') { $beatId = $_GET['beat_id']; }
    if (isset($_GET['store_id']) && $_GET['store_id'] != '') { $storeId = $_GET['store_id']; }
    
    if ( (isset($_GET['date_range']) && $_GET['date_range'] != '') || (isset($_GET['beat_id']) && $_GET['beat_id'] != '') || (isset($_GET['store_id']) && $_GET['store_id'] != '') ) {
        $showStatus = $listSection = 'style="display: block;"';
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
                                {{-- Start :: Date Range --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">Date Range</label>
                                        {{ Form::text('date_range', $dateRange, [
                                                                    'id' => 'date_range',
                                                                    'class' => 'form-control dateRangePickerWithoutTime',
                                                                    'placeholder' => '',
                                                                    'readonly' => true
                                                                    ]) }}
                                    </div>
                                </div>
                                {{-- End :: Date Range --}}

                                {{-- Start :: Beat --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">{{ __('custom_admin.label_beat') }}</label>
                                        <select name="beat_id" id="beat_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
                                            <option value="">--@lang('custom_admin.label_select')--</option>
                                        @foreach ($beats as $itemBeat)
                                            <option value="{{ $itemBeat->id }}" @if ($itemBeat->id == $beatId)selected @endif>{!! $itemBeat->title !!}</option>
                                        @endforeach
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
                                        @foreach ($stores as $itemStore)
                                            <option value="{{ $itemStore->id }}" @if ($itemStore->id == $storeId)selected @endif>{!! $itemStore->store_name !!} ({!! $itemStore->name_1.' - '.$itemStore->phone_no_1 !!})</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- End :: Store --}}
                                
                                <div class="col-md-2">
                                    <div class="form-group">
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

    <div class="row" id="payment-history-list" {!! $listSection !!}>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <div class="table-responsive mt-4-5">
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
                                <th class="actions">{{ __('custom_admin.label_action') }}</th>
                            </thead>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Payment modal content -->
    <div id="view-payment-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-dark">
                    <h4 class="modal-title" id="dark-header-modalLabel">{{ __('custom_admin.label_view_payment') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row" id="no-records-found" style="display: none;">
                        <div class="col-md-12">
                            {{ __('custom_admin.message_no_records_found') }}
                        </div>
                    </div>

                    <div class="row" id="records-found" style="display: none;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_distribution_area') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8" id="view-distribution-area"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_beat') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8" id="view-beat"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_store') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8" id="view-store"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_owner') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8" id="view-store-owner"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_phone') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8" id="view-store-phone"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_date') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8" id="view-date"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_amount') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8" id="view-total-amount"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_payment_mode') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8" id="view-payment-mode"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_payment_details') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8" id="view-payment-detail"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_note') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8" id="view-note"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-processing" class="btn btn-secondary btn-rounded" data-dismiss="modal"
                        aria-hidden="true"><i class="fas fa-times-circle"></i> {{ __('custom_admin.btn_close') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Edit Payment modal content -->
    <div id="edit-payment-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-dark">
                    <h4 class="modal-title" id="dark-header-modalLabel">{{ __('custom_admin.label_edit_payment') }}<span id="edit-store-details-area"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form name="updateCollectPaymentForm" id="updateCollectPaymentForm">
                    <input type="hidden" name="payment_id" id="payment-edit-id" value="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_date') }}<span class="red_star">*</span></label>
                                    {{ Form::text('date', null, [
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
                                    {{ Form::number('amount', null, [
                                                                'id' => 'total-amount',
                                                                'min' => 0,
                                                                'class' => 'form-control',
                                                                'placeholder' => ''
                                                                ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_password') }}<span class="red_star">*</span></label>
                                    {{ Form::password('password', [
                                                                'id' => 'password',
                                                                'class' => 'form-control',
                                                                'placeholder' => ''
                                                                ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_payment_mode') }}</label>
                                    {{ Form::text('payment_mode', null, [
                                                                'id' => 'payment-mode',
                                                                'class' => 'form-control',
                                                                'placeholder' => ''
                                                                ]) }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_payment_details') }}</label>
                                    {{ Form::text('payment_details', null, [
                                                                'id' => 'payment-details',
                                                                'class' => 'form-control',
                                                                'placeholder' => ''
                                                                ]) }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_note') }}</label>
                                    {{ Form::textarea('note', null, [
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
                        <button type="submit" id="btn-processing" class="btn btn-success btn-rounded updatePayment"><i class="far fa-save" aria-hidden="true"></i> {{ __('custom_admin.btn_update') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush