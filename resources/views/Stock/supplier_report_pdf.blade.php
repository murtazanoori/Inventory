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
                                                <th class="text-center">Supplier Name</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Product Name</th>
                                                <th class="text-center">Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($allData as $key => $item)
                                                <tr>
                                                    <td class="text-center"> {{ $key + 1 }} </td>
                                                    <td class="text-center"> {{ $item->supplier_details->name }} </td>
                                                    <td class="text-center">
                                                        {{ $item->unit_details ? $item->unit_details->unit : '-' }} </td>
                                                    <td class="text-center"> {{ $item->category_details->category }} </td>
                                                    <td class="text-center"> {{ $item->name }} </td>
                                                    <td class="text-center">{{ $item->quantity }}</td>
                                                </tr>
                                            @endforeach
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
