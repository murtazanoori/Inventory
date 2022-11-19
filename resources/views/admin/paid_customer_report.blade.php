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
                                <h4 class="mb-sm-0">Customer All</h4>



                            </div>
                        </div>
                    </div>

                    <div class="row" style=" margin-top: 6rem;">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Paid Customer Info</h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('customer.paidpdf') }}" target="_blank" class="btn btn-primary mb-4">
                                        <i class="fa fa-print"> Print Report</a></i>
                                    <div class="table-responsive">
                                        <table class="table table-bordered border text-nowrap mb-0" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer Name</th>
                                                    <th>invoice Number</th>
                                                    <th>Date</th>
                                                    <th>Due Amount</th>
                                                    <th width="5px" name="bstable-actions">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allData as $key => $item)
                                                    <tr>
                                                        <td> {{ $key + 1 }} </td>
                                                        <td> {{ $item->customer->name }} </td>
                                                        <td> {{ $item->invoice->invoice_no }} </td>
                                                        <td> {{ date('d-m-Y', strtotime($item->invoice->date)) }} </td>
                                                        <td> {{ $item->due_amount }} </td>
                                                        <td>
                                                            <div class="btn-list text-center">

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
