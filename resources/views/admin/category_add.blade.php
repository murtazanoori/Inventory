@extends('admin.admin_master')
@section('admin')
<div class="main-content app-content mt-0">
    <div class="side-app">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="card" style="margin-top:9rem; ">
        <div class="card-header">
            <div class="card-title">Add Category</div>
        </div>
        <div class="card-body">

            <form method="post" action="{{ route('category.store') }}" id="myForm">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text">Category</span>
                        <input type="text" name="category" class="form-control" aria-describedby="basic-addon1"
                          >
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
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    category: {
                        required : true,
                    },
                },
                messages :{
                    category: {
                        required : 'Please Enter A Category Item',
                    },
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>

@endsection
