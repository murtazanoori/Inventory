@extends('admin.admin_master')
@section('admin')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Invoice All</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row" style=" margin-top: 6rem;">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Invoice Info</h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('invoice.add') }}" class="btn btn-primary mb-4"> <i
                                            class="fa fa-plus-circle">
                                            Add Invoices</a></i>
                                    <div class="table-responsive">
                                        <table class="table table-bordered border text-nowrap mb-0" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Customer Name</th>
                                                    <th>Invoice Number</th>
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                    <th>Total Amount</th>
                                                    <th>Print</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($allData as $key => $item)
                                                    <tr>
                                                        <td> {{ $key + 1 }} </td>
                                                        <td> {{ $item->payment ? $item->payment->customer->name : '-' }} </td>
                                                        <td> {{ $item->id }} </td>
                                                        <td> {{ date('d-m-Y', strtotime($item->date)) }} </td>
                                                        <td> {{ $item->description ? $item->description : '-' }} </td>
                                                        <td> {{ $item->payment ? $item->payment->total_amount : '-' }} </td>
                                                        <td>
                                                            <div class="text-center">


                                                                <a href="{{ route('invoice.print', $item->id) }}"
                                                                    class="btn btn-success sm" title="print"
                                                                    id="print"> <i class="fa fa-print"></i> </a>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
