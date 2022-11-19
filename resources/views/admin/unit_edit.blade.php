@extends('admin.admin_master')
@section('admin')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <div class="card" style=" margin-top:9rem; ">
                <div class="card-header">
                    <div class="card-title">Add Units</div>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('unit.update') }}" id="myForm">
                        @csrf

                        <input type="hidden" name="id" value="{{ $unit->id }}">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Name</span>
                                <input type="text" name="unit" class="form-control" aria-describedby="basic-addon1"
                                    value="{{ $unit->unit }}">
                            </div>
                        </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-success" type="submit" value="Update unit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    unit: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please Enter A Unit',
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
