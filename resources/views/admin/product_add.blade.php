@extends('admin.admin_master')
@section('admin')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <div class="card" style=" margin-top:9rem; ">
                <div class="card-header">
                    <div class="card-title">Add Products</div>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('product.store') }}" id="myForm">
                        @csrf

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Product Name </label>
                            <div class="form-group col-sm-10">
                                <input name="name" class="form-control" type="text">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Supplier Name </label>
                            <div class="col-sm-10">
                                <select name="supplier_id" class="form-control select2-show-search form-select"
                                    aria-label="Default select example" required>
                                    <option selected="">Open this select menu</option>
                                    @foreach ($supplier as $supp)
                                        <option value="{{ $supp->id }}">{{ $supp->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Category Name </label>
                            <div class="col-sm-10">
                                <select name="category_id" class="form-control select2-show-search form-select"
                                    aria-label="Default select example" required>
                                    <option selected="">Open this select menu</option>
                                    @foreach ($category as $catt)
                                        <option value="{{ $catt->id }}">{{ $catt->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Unit Name </label>
                            <div class="col-sm-10">
                                <select name="unit_id" class="form-control select2-show-search form-select"
                                    aria-label="Default select example" required>
                                    <option selected="">Open this select menu</option>
                                    @foreach ($unit as $uni)
                                        <option value="{{ $uni->id }}">{{ $uni->unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-success" type="submit">Submit</button>
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
