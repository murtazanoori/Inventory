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
                                <h4 class="mb-sm-0">Customer Report</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 6rem;">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Customer Info</h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('customer.DailycustomerReportPdf') }}" class="btn btn-primary mb-4">
                                        <i class="fa fa-print"> Print Report</a></i>
                                    <div class="table-responsive">
                                        <table class="table table-bordered border text-nowrap mb-0" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Name</th>
                                                    <th>Invoice Number</th>
                                                    <th>Date</th>
                                                    <th>Due Amount</th>
                                                    <th name="bstable-actions">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allData as $key => $item)
                                                    <tr>
                                                        <td> {{ $key + 1 }} </td>
                                                        <td> {{ $item->customer ? $item->customer->name : '-' }} </td>
                                                        <td> {{ $item->invoice ? $item->invoice->invoice_no : '-' }} </td>
                                                        <td> {{ $item->invoice ? date('d-m-Y', strtotime($item->invoice->date)) : '-' }}
                                                        </td>
                                                        <td> {{ $item->due_amount ? $item->due_amount : '-' }} </td>
                                                        <td width="5%">
                                                            <div class="btn-list text-center">

                                                                <a href="{{ route('customer.reportedit', $item->invoice_id) }} "
                                                                    class="btn btn-sm btn-primary " title="Edit">
                                                                    <i class="fe fe-edit"></i> </a>

                                                                <a href="{{ route('customer.invoicedetails', $item->invoice_id) }} "
                                                                    class="btn btn-sm btn-primary" title="Show">
                                                                    <i class="fe fe-eye"></i> </a>


                                                            </div>
                                                    <tr>
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
