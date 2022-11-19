@extends('admin.admin_master')
@section('admin')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">

                <!-- ROW-1 OPEN -->
                <div class="row" style=" margin-top: 6rem;">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a class="header-brand" href="{{ route('dashboard') }}">
                                            <img src="{{ asset('assets/images/brand/print-invoice.png') }}"
                                                class="header-brand-img desktop-logo" alt="Inventory Logo">
                                        </a>
                                        <div>
                                            <address class="pt-3">
                                                Address : Darlaman, Kabul, Afghanistan<br>
                                                Email : Murtazanoori53@gmail.com
                                            </address>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive push">
                                    <h4>Daily Purchase Report <span
                                            class="badge rounded-pill bg-default badge-sm me-1 mb-1 mt-1">{{ date('d-m-Y', strtotime($start_date)) }}</span>
                                        -
                                        <span
                                            class="badge rounded-pill bg-default badge-sm me-1 mb-1 mt-1">{{ date('d-m-Y', strtotime($end_date)) }}</span>
                                    </h4>
                                    <table class="table table-bordered table-hover mb-0 text-nowrap">
                                        <tbody>
                                            <tr class=" ">
                                                <th class="text-center">SL</th>
                                                <th class="text-center">Purchase Number</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Product Name</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Unit Price</th>
                                                <th class="text-center">Total Price</th>
                                            </tr>
                                            @php
                                                $total_sum = '0';
                                            @endphp
                                            @foreach ($allData as $key => $item)
                                                <tr>
                                                    <td class="text-center"> {{ $key + 1 }} </td>
                                                    <td class="text-center"> {{ $item->purchase_no }} </td>
                                                    <td class="text-center"> {{ date('d-m-Y', strtotime($item->date)) }}
                                                    </td>
                                                    <td class="text-center"> {{ $item->product_details->name }} </td>

                                                    <td class="text-center"> {{ $item->buying_qty }}
                                                        {{ $item->product_details->unit_details->unit }} </td>
                                                    <td class="text-center"> {{ $item->unit_price }}</td>
                                                    <td class="text-center"> {{ $item->buying_price }}</td>
                                                </tr>
                                                @php
                                                    $total_sum += $item->buying_price;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center"><strong>Grand Total</strong></td>
                                                <td class="thick-line text-center">${{ $total_sum }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-print-none text-end" style="padding-right: 20px; padding-bottom:20px;">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-danger mb-1">Print Invoice <i
                                            class="fa fa-print"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL-END -->
                </div>
                <!-- ROW-1 CLOSED -->

            </div>
        </div>
    </div>
@endsection
