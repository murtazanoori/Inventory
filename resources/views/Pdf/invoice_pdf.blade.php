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
                                                Darlaman, Kabul, Afghanistan<br>
                                                Murtazanoori53@gmail.com
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 text-end border-bottom border-lg-0">
                                        <h3>#INV-{{ $invoice->invoice_no }}</h3>
                                        <h5>Date Issued: {{ date('d-m-Y', strtotime($invoice->date)) }}</h5>
                                    </div>
                                </div>
                                @php
                                    $payment = App\Models\Payment::where('invoice_id', $invoice->id)->first();
                                @endphp
                                <div class="col-xl">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Customer Invoice</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table text-nowrap text-md-nowrap mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Mobile Number</th>
                                                            <th>Address</th>
                                                            <th>Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $payment->customer->name }}</td>
                                                            <td>{{ $payment->customer->mobile_no }}</td>
                                                            <td>{{ $payment->customer->address }}</td>
                                                            <td>{{ $invoice->description }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>







                                <div class="table-responsive push">
                                    <table class="table table-bordered table-hover mb-0 text-nowrap">
                                        <tbody>
                                            @php
                                                $total_sum = '0';
                                            @endphp
                                            @foreach ($invoice->invoice_details as $key => $details)
                                                <tr class=" ">
                                                    <th class="text-center">SL</th>
                                                    <th class="text-center">Category</th>
                                                    <th class="text-center">Product</th>
                                                    <th class="text-center">Current Stock</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Unit Price</th>
                                                    <th class="text-center">Total Price</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">SL</td>
                                                    <td class="text-center">{{ $details->category->category }}</td>
                                                    <td class="text-center">{{ $details->product->name }}</td>
                                                    <td class="text-center">{{ $details->product->quantity }}</td>
                                                    <td class="text-center">{{ $details->selling_qty }}</td>
                                                    <td class="text-center">{{ $details->unit_price }}</td>
                                                    <td class="text-center">{{ $details->selling_price }}</td>
                                                </tr>
                                                @php
                                                    $total_sum += $details->selling_price;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center"><strong>Sub Total</strong></td>
                                                <td class="thick-line text-center">${{ $total_sum }}</td>
                                            </tr>
                                            <tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center"><strong>Discount Amount</strong></td>
                                                <td class="thick-line text-center">${{ $payment->discount_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center"><strong>Paid Amount</strong></td>
                                                <td class="thick-line text-center">${{ $payment->paid_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center"><strong>Due Amount</strong></td>
                                                <td class="thick-line text-center">${{ $payment->due_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center"><strong>Grand Total</strong></td>
                                                <td class="thick-line text-center">${{ $payment->total_amount }}</td>
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
