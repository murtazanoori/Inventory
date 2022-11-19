@extends('admin.admin_master')
@section('admin')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <div class="card" style=" margin-top:9rem; ">
                <div class="card-header">
                    <div class="card-title">Add Supplier</div>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('supplier.update') }}" id="myForm">
                        @csrf

                        <input type="hidden" name="id" value="{{ $supplier->id }}">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Name</span>
                                <input type="text" name="name" class="form-control" aria-describedby="basic-addon1"
                                    value="{{ $supplier->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Last Name</span>
                                <input type="text" class="form-control" name="lname" aria-describedby="basic-addon1"
                                    value="{{ $supplier->lname }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Mobile Number</span>
                                <input type="number" class="form-control" name="mobile_no" aria-describedby="basic-addon1"
                                    value="{{ $supplier->mobile_no }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Address</span>
                                <input type="text" class="form-control" name="address" aria-describedby="basic-addon1"
                                    value="{{ $supplier->address }}">
                            </div>
                        </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-success" type="submit" value="Update Supplier">Submit</button>
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
                    lname: {
                        required: true,
                    },
                    mobile_no: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please Enter Your Name',
                    },
                    lname: {
                        required: 'Please Enter Your Last Name',
                    },
                    mobile_no: {
                        required: 'Please Enter Your Mobile Number',
                    },
                    address: {
                        required: 'Please Enter Your Address',
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
