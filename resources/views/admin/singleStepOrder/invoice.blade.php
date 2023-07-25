<!DOCTYPE html>
<html dir="ltr" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pioneer Invoice</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <style>
    .fs14{font-size: 14px !important;}
    .fs12{font-size: 12px !important;}
    </style>
</head>
<body>
    <table style="margin:0px 0 80px;padding:0;" width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center">
                <img src="{{asset('images/admin/logo.png')}}" alt="" width="250">
            </td>
        </tr>
    </table>

    <table style="margin:0 0 30px;padding:0;font-size:14px;font-family:'Arial', sans-serif;" width="100%" cellpadding="5" cellspacing="0" border="1">
        <tbody>
            <tr>
                <td class="fs14"><strong>@lang('custom_admin.label_store'):</strong> {!! $invoiceDetails->singleStepOrder->storeDetails->store_name ?? 'NA' !!}</td>
                <td class="fs14"><strong>@lang('custom_admin.label_owner'):</strong> {!! $invoiceDetails->singleStepOrder->storeDetails->name_1 ?? 'NA' !!}</td>
                <td class="fs14"><strong>@lang('custom_admin.label_phone'):</strong> {!! $invoiceDetails->singleStepOrder->storeDetails->phone_no_1 ?? 'NA' !!}</td>
                <td class="fs14"><strong>@lang('custom_admin.label_representative'):</strong> {!! Auth::guard('admin')->user()->full_name ?? 'NA' !!}</td>
            </tr>
        </tbody>
    </table>
    <table style="margin:0 0 30px;padding:0;width:100%;font-size:14px;font-family:'Arial', sans-serif;" width="100%" cellpadding="5" cellspacing="0" border="1">
        <thead>
            <tr class="fs12">
                <th scope="col">@lang('custom_admin.label_category')</th>
                <th scope="col">@lang('custom_admin.label_product')</th>
                <th scope="col">@lang('custom_admin.label_qty')</th>
                <th scope="col">@lang('custom_admin.label_unit_price')</th>
                <th scope="col">@lang('custom_admin.label_discount_percent')</th>
                <th scope="col">@lang('custom_admin.label_discount_amount')</th>
                <th scope="col">@lang('custom_admin.label_total_price')</th>
                <th scope="col">@lang('custom_admin.label_status')</th>
            </tr>
        </thead>
        <tbody>
    @php $totalCount = 0; $totalAmount = 0; @endphp
    @if ($invoiceDetails->invoiceDetails)
        @foreach ($invoiceDetails->invoiceDetails as $keyItem => $item)
            @php $totalCount += $item->qty; $totalAmount += $item->total_price; @endphp
            <tr class="fs12">
                <td scope="col">{{ $item->category }}</td>
                <td scope="col">{{ $item->product }}</td>
                <td scope="col">{{ $item->qty }}</td>
                <td scope="col">{{ formatToTwoDecimalPlaces($item->unit_price) }}</td>
                <td scope="col">{{ $item->discount_percent ? formatToTwoDecimalPlaces($item->discount_percent) : '-' }}</td>
                <td scope="col">{{ $item->discount_amount ? formatToTwoDecimalPlaces($item->discount_amount) : '-' }}</td>
                <td scope="col">{{ formatToTwoDecimalPlaces($item->total_price) }}</td>
                <td scope="col">
                @if ($item->status == 'A') {{ 'Allocated' }}
                @elseif ($item->status == 'S') {{ 'Shipped' }}
                @elseif ($item->status == 'I') {{ 'Invoiced' }}
                @elseif ($item->status == 'H') {{ 'On Hold' }}
                @else {{ 'Complete' }}
                @endif
                </td>
            </tr>
        @endforeach
    @endif
        </tbody>
        @if (count($invoiceDetails->invoiceDetails) > 0)
        <tbody>
            <tr>
                <th scope="row" colspan="2">&nbsp;</th>
                <td class="fs12">{{ $totalCount }}</td>
                <td class="fs12" colspan="3">&nbsp;</td>
                <td class="fs12">{{ formatToTwoDecimalPlaces($totalAmount) }}</td>
                <td class="fs12" colspan="1">&nbsp;</td>
            </tr>
        </tbody>
        @endif
    </table>
</body>
</html>