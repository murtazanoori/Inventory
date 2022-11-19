@extends('admin.admin_master')
@section('admin')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <div class="card" style=" margin-top:9rem; ">
                <div class="card-header">
                    <div class="card-title">Add Product</div>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('product.update') }}" id="myForm">
                        @csrf

                        <input type="hidden" name="id" value="{{ $product->id }}">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Product Name</span>
                                <input type="text" name="name" class="form-control" aria-describedby="basic-addon1"
                                    value="{{ $product->name }}">
                            </div>
                        </div>
                        <label for="example-text-input" class="col-sm-2 col-form-label">Supplier</label>
                        <select name="supplier_id" class="form-control form-select" required>
                            <option selected="">Please Select A Supplier</option>
                            @foreach ($supplier as $supp)
                                <option value="{{ $supp->id }}"
                                    {{ $supp->id == $product->supplier_id ? 'selected' : '' }}>{{ $supp->name }}</option>
                            @endforeach
                        </select>


                        <label for="example-text-input" class="col-sm-2 col-form-label">Category</label>
                        <select name="category_id" class="form-control form-select">
                            <option selected="">Please Select A Category</option>
                            @foreach ($category as $catt)
                                <option value="{{ $catt->id }}"
                                    {{ $catt->id == $product->category_id ? 'selected' : '' }}>{{ $catt->category }}
                                </option>
                            @endforeach
                        </select>


                        <label for="example-text-input" class="col-sm-2 col-form-label">Unit</label>
                        <select name="unit_id" class="form-control form-select">
                            <option selected="">Please Select A Unit</option>
                            @foreach ($unit as $uni)
                                <option value="{{ $uni->id }}" {{ $uni->id == $product->unit_id ? 'selected' : '' }}>
                                    {{ $uni->unit }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-success" type="submit" value="Update Product">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    supplier_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    unit_id: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please Enter Product Name',
                    },
                    supplier_id: {
                        required: 'Please Select A Supplier',
                    },
                    category_id: {
                        required: 'Please Select A Category',
                    },
                    unit_id: {
                        required: 'Please Select A Unit',
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
