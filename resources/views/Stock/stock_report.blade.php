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
                                <h4 class="mb-sm-0">Stock All</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row" style=" margin-top: 6rem;">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Stock Report</h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('stock.reportPdf') }}" class="btn btn-primary mb-4"> <i
                                            class="fa fa-print"> Stock Report Print</a></i>
                                    <div class="table-responsive">
                                        <table class="table table-bordered border text-nowrap mb-0" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">SL</th>
                                                    <th class="text-center">Supplier Name</th>
                                                    <th class="text-center">Unit</th>
                                                    <th class="text-center">Category</th>
                                                    <th class="text-center">Product Name</th>
                                                    <th class="text-center">Purchased Quantity</th>
                                                    <th class="text-center">Orderd Quantity</th>
                                                    <th class="text-center">Stock</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($allData as $key => $item)
                                                    @php
                                                        $buying_total = App\Models\Purchase::where('category_id', $item->category_id)
                                                            ->where('product_id', $item->id)
                                                            ->where('status', '1')
                                                            ->sum('buying_qty');
                                                        $selling_total = App\Models\InvoiceDetail::where('category_id', $item->category_id)
                                                            ->where('product_id', $item->id)
                                                            ->where('status', '1')
                                                            ->sum('selling_qty');
                                                    @endphp
                                                    <tr>
                                                        <td class="text-center"> {{ $key + 1 }} </td>
                                                        <td class="text-center"> {{ $item->supplier_details->name }} </td>
                                                        <td class="text-center">
                                                            {{ $item->unit_details ? $item->unit_details->unit : '-' }} </td>
                                                        <td class="text-center"> {{ $item->category_details->category }}
                                                        </td>
                                                        <td class="text-center"> {{ $item->name }} </td>
                                                        <td class="text-center"> {{ $buying_total }} </td>
                                                        <td class="text-center"> {{ $selling_total }} </td>
                                                        <td class="text-center">{{ $item->quantity }}</td>
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
