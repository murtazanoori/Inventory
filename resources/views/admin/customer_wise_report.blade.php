@extends('admin.admin_master')
@section('admin')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <div class="card" style=" margin-top:9rem; ">
                <div class="card-header">
                    <div class="card-title">Search Customer Report</div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12 text-center">

                            <strong>Customer Credit Report</strong>
                            <input type="radio" class="search_value" name="supplier_wise" value="customer_credit">&nbsp;
                            &nbsp;


                            <strong>Customer Paid Report</strong>
                            <input type="radio" class="search_value" name="supplier_wise" value="customer_paid">

                        </div>
                        <br>
                        <form action="{{ route('customer.wisereportpdf') }}" method="GET" id="myForm" target="_blank">
                            <div class="col-md-4" style="display: none;">
                                <div class="md-3 form-group">
                                    <label for="example-text-input" class="form-label" style="margin-left:5px;">Supplier
                                        Name
                                    </label>
                                    <select name="customer_id" id="customer_id" class="form-select">
                                        <option value="">Select Customer </option>
                                        @foreach ($customers as $cust)
                                            <option value="{{ $cust->id }}">{{ $cust->name }} -
                                                {{ $cust->mobile_no }}</option>
                                        @endforeach
                                        <option value="0">New Customer </option>
                                    </select>
                                </div>
                                <button class="btn btn-success" type="submit" style="margin-left: 2px;">Search</button>
                            </div>
                    </div>
                    </form>






                    {{-- product and category dropdown --}}
                    <div class="show_product" style="display:none; ">
                        <form method="GET" action="{{ route('customer.customerpaidpdf') }}" id="myForm"
                            target="_blank">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Category Name </label>
                                        <select name="customer_id" id="customer_id" class="form-select">
                                            <option value="">Select Customer </option>
                                            @foreach ($customers as $cust)
                                                <option value="{{ $cust->id }}">{{ $cust->name }} -
                                                    {{ $cust->mobile_no }}</option>
                                            @endforeach
                                            <option value="0">New Customer </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-success" type="submit" style="margin-left:1px;">Search</button>
                        </form>

                    </div>
                    <!--  /// End Product Wise  -->
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).on('change', '.search_value', function() {
            var search_value = $(this).val();
            if (search_value == 'customer_credit') {
                $('.col-md-4').show();
            } else {
                $('.col-md-4').hide();
            }
        });
    </script>



    <script type="text/javascript">
        $(document).on('change', '.search_value', function() {
            var search_value = $(this).val();
            if (search_value == 'customer_paid') {
                $('.show_product').show();
            } else {
                $('.show_product').hide();
            }
        });
    </script>




    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    supplier_id: {
                        required: true,
                    },
                },
                messages: {
                    supplier_id: {
                        required: 'Please Select A Supplier',
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
@endsection
