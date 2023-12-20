@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

    <style type="text/css">
    .actions {pointer-events: none !important;}
    </style>

    @php
    $dateRange = '2023-09-01 - 2023-11-15'; $storeId = '21';
    $hideStatus = 'style="display: none;"';
    $showStatus = 'style="display: block;"';
    if (isset($_GET['date_range']) && $_GET['date_range'] != '') { $dateRange = $_GET['date_range']; }
    if (isset($_GET['store_id']) && $_GET['store_id'] != '') { $storeId = $_GET['store_id']; }
    
    if ( (isset($_GET['date_range']) && $_GET['date_range'] != '') || (isset($_GET['store_id']) && $_GET['store_id'] != '') ) {
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
                                {{-- Start :: Date Range --}}
                                <div class="col-md-4">
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
                                {{-- Start :: Store --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-dark font-bold">{{ __('custom_admin.label_store') }}</label>
                                        <select name="store_id" id="store_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
                                            <option value="">--@lang('custom_admin.label_select')--</option>
                                        @if ($stores)
                                            @foreach ($stores as $itemStore)
                                            <option value="{{ $itemStore->id }}" @if ($storeId == $itemStore->id)selected @endif>{!! $itemStore->store_name !!}</option>
                                            @endforeach
                                        @endif
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        {{ $pageTitle }}

                        {{-- <a class="btn btn-dark waves-effect waves-light btn-rounded shadow-md pr-3 pl-3 float-right" href="javascript: void(0);" data-toggle="modal" data-target="#collect-payment-modal">
                            <i class="fa fa-plus-circle"></i> {{ __('custom_admin.label_collect_payment') }}
                        </a> --}}
                    </h4>
                    <div class="table-responsive mt-4-5">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th class="firstColumn">{{ __('custom_admin.label_hash') }}</th>
                                    <th>{{ __('custom_admin.label_date') }}</th>
                                    <th>{{ __('custom_admin.label_store') }}</th>
                                    <th>{{ __('custom_admin.label_owner') }}</th>
                                    <th>{{ __('custom_admin.label_phone') }}</th>
                                    <th>{{ __('custom_admin.label_amount') }}</th>
                                    <th>{{ __('custom_admin.label_reference_no') }}</th>
                                    <th class="actions">{{ __('custom_admin.label_action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2023-12-02</td>
                                    <td>SARAT STORES</td>
                                    <td>SHIBLAL SARKAR</td>
                                    <td>9231879588</td>
                                    <td>15000.00</td>
                                    <td>8961</td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2023-12-01</td>
                                    <td>APANJAN</td>
                                    <td>AJAY</td>
                                    <td>9932868725</td>
                                    <td>6000.00</td>
                                    <td>8960</td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2023-11-25</td>
                                    <td>BIDYAMANDIR NABADWIP</td>
                                    <td>AJAY</td>
                                    <td>9932868725</td>
                                    <td>2000.00</td>
                                    <td></td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>2023-11-15</td>
                                    <td>Moden Stationary</td>
                                    <td>Suman Sur</td>
                                    <td>9800120623</td>
                                    <td>3000.00</td>
                                    <td>8950</td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>2023-11-08</td>
                                    <td>Trapti Stores</td>
                                    <td>Surojit Das</td>
                                    <td>9832710097</td>
                                    <td>10000.00</td>
                                    <td></td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>2023-11-02</td>
                                    <td>SARAT STORES</td>
                                    <td>SHIBLAL SARKAR</td>
                                    <td>9231879588</td>
                                    <td>500.00</td>
                                    <td>8945</td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>2023-10-25</td>
                                    <td>BIDYAMANDIR NABADWIP</td>
                                    <td>AJAY</td>
                                    <td>9932868725</td>
                                    <td>6000.00</td>
                                    <td>8944</td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>2023-10-22</td>
                                    <td>Moden Stationary</td>
                                    <td>Suman Sur</td>
                                    <td>9800120623</td>
                                    <td>4400.00</td>
                                    <td>8942</td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>2023-09-22</td>
                                    <td>Moden Stationary</td>
                                    <td>Suman Sur</td>
                                    <td>9800120623</td>
                                    <td>2500.00</td>
                                    <td></td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>2023-10-08</td>
                                    <td>Trapti Stores</td>
                                    <td>Surojit Das</td>
                                    <td>9832710097</td>
                                    <td>5000.00</td>
                                    <td>8940</td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        {{ $pageTitle }} - After Filter View

                        {{-- <a class="btn btn-dark waves-effect waves-light btn-rounded shadow-md pr-3 pl-3 float-right" href="javascript: void(0);" data-toggle="modal" data-target="#collect-payment-modal">
                            <i class="fa fa-plus-circle"></i> {{ __('custom_admin.label_collect_payment') }}
                        </a> --}}
                    </h4>
                    <div class="table-responsive mt-4-5">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th class="firstColumn">{{ __('custom_admin.label_hash') }}</th>
                                    <th>{{ __('custom_admin.label_date') }}</th>
                                    <th>{{ __('custom_admin.label_store') }}</th>
                                    <th>{{ __('custom_admin.label_owner') }}</th>
                                    <th>{{ __('custom_admin.label_phone') }}</th>
                                    <th>{{ __('custom_admin.label_amount') }}</th>
                                    <th>{{ __('custom_admin.label_reference_no') }}</th>
                                    <th class="actions">{{ __('custom_admin.label_action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2023-11-15</td>
                                    <td>Moden Stationary</td>
                                    <td>Suman Sur</td>
                                    <td>9800120623</td>
                                    <td>3000.00</td>
                                    <td>8950</td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2023-10-22</td>
                                    <td>Moden Stationary</td>
                                    <td>Suman Sur</td>
                                    <td>9800120623</td>
                                    <td>4400.00</td>
                                    <td>8942</td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>2023-09-22</td>
                                    <td>Moden Stationary</td>
                                    <td>Suman Sur</td>
                                    <td>9800120623</td>
                                    <td>2500.00</td>
                                    <td></td>
                                    <td>
                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" data-toggle="modal" data-target="#view-payment-modal"><i class="fa fa-eye ml_minus_2"></i></a>

                                        <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" data-toggle="modal" data-target="#edit-payment-modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Collect Payment modal content -->
    <div id="collect-payment-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-dark">
                    <h4 class="modal-title" id="dark-header-modalLabel">{{ __('custom_admin.label_collect_payment') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-dark font-bold">{{ __('custom_admin.label_store') }}<span class="red_star">*</span></label>
                                <select name="store_id" id="store_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
                                    <option value="">--@lang('custom_admin.label_select')--</option>
                                @if ($stores)
                                    @foreach ($stores as $itemStore)
                                    <option value="{{ $itemStore->id }}">{!! $itemStore->store_name !!}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>
                        
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
                                {{ Form::number('amount', null, [
                                                            'id' => 'amount',
                                                            'min' => 0,
                                                            'class' => 'form-control',
                                                            'placeholder' => ''
                                                            ]) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-dark font-bold">{{ __('custom_admin.label_reference_no') }}</label>
                                {{ Form::text('reference', null, [
                                                            'id' => 'reference',
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
                    <button type="submit" id="btn-processing" class="btn btn-success btn-rounded"><i class="far fa-save" aria-hidden="true"></i> {{ __('custom_admin.label_save') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Edit Payment modal content -->
    <div id="edit-payment-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-dark">
                    <h4 class="modal-title" id="dark-header-modalLabel">{{ __('custom_admin.label_edit_payment') }} - Academy (Krishandu pramanik)</h4>
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

    <!-- View Payment modal content -->
    <div id="view-payment-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-dark">
                    <h4 class="modal-title" id="dark-header-modalLabel">{{ __('custom_admin.label_view_payment') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_store') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">SARAT STORES</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_owner') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">SHIBLAL SARKAR</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_phone') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">9231879588</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_date') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">2023-12-02</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_amount') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">15000.00</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_reference_no') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">8963</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <label class="text-dark font-bold">{{ __('custom_admin.label_note') }}</label>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">Lorem Ipsum is dummy text Lorem Ipsum is dummy text Lorem Ipsum is dummy text.</div>
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