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
                                    <table class="table table-bordered border text-nowrap mb-0" id="datatable">
                                        <thead>
                                            <tr>

                                                <th class="text-center">SL</th>
                                                <th class="text-center">Customer Name</th>
                                                <th class="text-center">Invoice Number</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Due Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @php
                                                    $total_due = '0';
                                                @endphp
                                                @foreach ($allData as $key => $item)
                                                    <td class="text-center"> {{ $key + 1 }} </td>
                                                    <td class="text-center"> {{ $item->customer->name }} </td>
                                                    <td class="text-center"> {{ $item->invoice->invoice_no }} </td>
                                                    <td class="text-center">
                                                        {{ date('d-m-Y', strtotime($item->invoice->date)) }} </td>
                                                    <td class="text-center">{{ $item->due_amount }}</td>
                                            </tr>
                                            @php
                                                $total_due += $item->due_amount;
                                            @endphp
                                            @endforeach
                                            <tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center"><strong>Grand Total</strong></td>
                                                <td class="thick-line text-center">${{ $total_due }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @php
                                $date = new DateTime('now', new DateTimeZone('asia/kabul'));
                            @endphp
                            <i style="margin-left: 15px;">
                                Printing Time : {{ $date->format('F j, Y, g:i a') }}
                            </i>
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
