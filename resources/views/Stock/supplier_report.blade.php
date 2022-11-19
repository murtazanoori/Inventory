@extends('admin.admin_master')
@section('admin')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <div class="card" style=" margin-top:9rem; ">
                <div class="card-header">
                    <div class="card-title">Search Supplier & Product Report</div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12 text-center">

                            <strong>Supplier Report</strong>
                            <input type="radio" class="search_value" name="supplier_wise" value="supplier_wise">&nbsp;
                            &nbsp;


                            <strong>Product Report</strong>
                            <input type="radio" class="search_value" name="supplier_wise" value="supplier_product">

                        </div>
                        <br>
                        <form action="{{ route('stock.supplierreportPdf') }}" method="GET" id="myForm" target="_blank">
                            <div class="col-md-4" style="display: none;">
                                <div class="md-3 form-group">
                                    <label for="example-text-input" class="form-label" style="margin-left:5px;">Supplier
                                        Name
                                    </label>
                                    <select id="supplier_id" name="supplier_id"
                                        class="form-control select2-show-search form-select"
                                        aria-label="Default select example">
                                        <option value="">Open this select menu</option>
                                        @foreach ($supplier as $supp)
                                            <option value="{{ $supp->id }}">{{ $supp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-success" type="submit" style="margin-left: 2px;">Search</button>
                            </div>
                    </div>
                    </form>






                    {{-- product and category dropdown --}}
                    <div class="show_product" style="display:none; ">
                        <form method="GET" action="{{ route('stock.productreportPdf') }}" id="myForm" target="_blank">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Category Name </label>
                                        <select name="category_id" id="category_id"
                                            class="form-control select2-show-search form-select"
                                            aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            @foreach ($category as $catt)
                                                <option value="{{ $catt->id }}">{{ $catt->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Product Name </label>
                                        <select name="product_id" id="product_id"
                                            class="form-control select2-show-search form-select"
                                            aria-label="Default select example">
                                            <option selected="">Open this select menu</option>

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
            if (search_value == 'supplier_wise') {
                $('.col-md-4').show();
            } else {
                $('.col-md-4').hide();
            }
        });
    </script>



    <script type="text/javascript">
        $(document).on('change', '.search_value', function() {
            var search_value = $(this).val();
            if (search_value == 'supplier_product') {
                $('.show_product').show();
            } else {
                $('.show_product').hide();
            }
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#category_id', function() {
                var category_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-product') }}",
                    type: "GET",
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select Category</option>';
                        $.each(data, function(key, v) {
                            html += '<option value=" ' + v.id + ' "> ' + v.name +
                                '</option>';
                        });
                        $('#product_id').html(html);
                    }
                })
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#product_id', function() {
                var product_id = $(this).val();
                $.ajax({
                    url: "{{ route('check-product-stock') }}",
                    type: "GET",
                    data: {
                        product_id: product_id
                    },
                    success: function(data) {
                        $('#current_stock_qty').val(data);
                    }
                });
            });
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
