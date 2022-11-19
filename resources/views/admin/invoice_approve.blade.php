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
                    @php
                        $payment = App\Models\Payment::where('invoice_id', $invoice->id)->first();
                    @endphp
                    <div class="row" style=" margin-top: 6rem;">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Invoice Info</h3>
                                </div>
                                <div class="card-body">

                                    <h4>Invoice Number: #{{ $invoice->invoice_no }}
                                        <br> Date :{{ date('d-m-Y', strtotime($invoice->date)) }}
                                    </h4>
                                    <a href="{{ route('invoice.pending') }}" class="btn btn-primary mb-4"> <i
                                            class="fa fa-plus-circle">
                                            Pending Invoices</a></i>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered border text-nowrap mb-0"
                                                            id="basic-edit">
                                                            <thead>
                                                                <tr>
                                                                    <td>
                                                                        <p>Name :
                                                                            <strong>{{ $payment->customer->name }}</strong>
                                                                        </p>
                                                                    </td>
                                                                    <td>
                                                                        <p>Mobile Number :
                                                                            <strong>{{ $payment->customer->mobile_no }}</strong>
                                                                        </p>
                                                                    </td>
                                                                    <td>
                                                                        <p>Address :
                                                                            <strong>{{ $payment->customer->address }}</strong>
                                                                        </p>
                                                                    </td>
                                                                    <td>
                                                                        <p>
                                                                            Description : <strong>
                                                                                {{ $invoice->description }}
                                                                            </strong>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>


                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <form
                                                                                action="{{ route('approve.store', $invoice->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <table
                                                                                    class="table table-bordered border text-nowrap mb-0"
                                                                                    id="basic-edit">
                                                                                    <thead>
                                                                                        @php
                                                                                            $total_sum = '0';
                                                                                        @endphp
                                                                                        @foreach ($invoice->invoice_details as $key => $details)
                                                                                            <tr>


                                                                                                <input type="hidden"
                                                                                                    name="category_id[]"
                                                                                                    value="{{ $details->category_id }}">
                                                                                                <input type="hidden"
                                                                                                    name="product_id[]"
                                                                                                    value="{{ $details->product_id }}">
                                                                                                <input type="hidden"
                                                                                                    name="selling_qty[{{ $details->id }}]"
                                                                                                    value="{{ $details->selling_qty }}">
                                                                                                <th>SL</th>
                                                                                                <th>Category</th>
                                                                                                <th>Product Name</th>
                                                                                                <th
                                                                                                    style="background-color: #ddd">
                                                                                                    Current Stock</th>
                                                                                                <th>Quantity</th>
                                                                                                <th>Unit Price</th>
                                                                                                <th>Total Price</th>
                                                                                            </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="text-center">SL</td>
                                                                                            <td class="text-center">
                                                                                                {{ $details->category->category }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $details->product->name }}
                                                                                            </td>
                                                                                            <td class="text-center"
                                                                                                style="background: #ddd">
                                                                                                {{ $details->product->quantity }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $details->selling_qty }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $details->unit_price }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $details->selling_price }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        @php
                                                                                            $total_sum += $details->selling_price;
                                                                                        @endphp
                                                                                        @endforeach
                                                                                        <tr>
                                                                                            <td colspan="6">
                                                                                                Sub Total
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $total_sum }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="6">
                                                                                                Discount
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $payment->discount_amount }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="6">
                                                                                                Paid Amount
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $payment->paid_amount }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="6">
                                                                                                Due Amount
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $payment->due_amount }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="6">
                                                                                                Grand Total
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $payment->total_amount }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <br>
                                                                                <button class="btn btn-success"
                                                                                    type="submit">Invoice Approve</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
