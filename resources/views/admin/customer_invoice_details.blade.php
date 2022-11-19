@extends('admin.admin_master')
@section('admin')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <div class="main-container container-fluid">

                <!-- ROW-1 OPEN -->
                <div class="row" style=" margin-top: 6rem;">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('customer.dailyreport') }}" class="btn btn-danger fa fa-arrow-circle-left"
                                    style="float: right; margin-right:5px;"> Back</a>
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

                                        <h3>#INV-{{ $payment->invoice->invoice_no }}</h3>

                                    </div>
                                </div>

                                <div class="col-xl">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Customer Invoice Edit</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table text-nowrap text-md-nowrap mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Mobile Number</th>
                                                            <th>Address</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $payment->customer->name }}</td>
                                                            <td>{{ $payment->customer->mobile_no }}</td>
                                                            <td>{{ $payment->customer->address }}</td>
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
                                                $invoice_details = App\Models\InvoiceDetail::where('invoice_id', $payment->invoice_id)->get();
                                            @endphp
                                            @foreach ($invoice_details as $key => $details)
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
                                                <input type="hidden" name="new_paid_amount" id="new_padi_amount"
                                                    value="{{ $payment->due_amount }}">
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

                                            <tr>
                                                <td colspan="7" style="text-align: center; font-weight:bold; ">
                                                    <strong>Paid Summary</strong></td>
                                            </tr>

                                            <tr>
                                                <td colspan="4" style="text-align: center; font-weight:bold;">Changed
                                                    Amount Date</td>
                                                <td colspan="3" style="text-align: center; font-weight:bold;">
                                                    Current Changed Amount
                                                </td>
                                            </tr>
                                            @php
                                                $payment_details = App\Models\PaymentDetail::where('invoice_id', $payment->invoice_id)->get();
                                            @endphp
                                            @foreach ($payment_details as $item)
                                                <tr>
                                                    <td colspan="4" style="text-align: center; font-weight:bold;">
                                                        {{ date('d-m-Y', strtotime($item->date)) }}</td>
                                                    <td colspan="3" style="text-align: center; font-weight:bold;">
                                                        {{ $item->current_paid_amount }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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




    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    paid_status: {
                        required: true,
                    },
                },
                messages: {
                    paid_status: {
                        required: 'Please Select An Option',
                    },
                    date: {
                        required: true,
                    },
                },
                messages: {
                    date: {
                        required: 'Please Select A Date',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on('change', '#paid_status', function() {
            var paid_status = $(this).val();
            if (paid_status == 'partial_paid') {
                $('.paid_amount').show();
            } else {
                $('.paid_amount').hide();
            }
        });
    </script>
@endsection
