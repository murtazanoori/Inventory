@extends('admin.admin_master')
@section('admin')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <div class="card" style=" margin-top:7rem; ">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Daily Invoice Report </h4><br><br>
                                <form action="{{ route('invoice.DailyInvoiceReportPdf') }}" method="" target="_blank"
                                    id="myForm">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="md-4 form-group">
                                                <label for="example-text-input" class="form-label">Start Date</label>
                                                <input class="form-control example-date-input" name="start_date"
                                                    type="date" id="start_date">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="md-4 form-group">
                                                <label for="example-text-input" class="form-label">End Date</label>
                                                <input class="form-control example-date-input" name="end_date"
                                                    type="date" id="end_date">
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="margin-top: 35px;">
                                            <div class="md-4">
                                                <button class="btn btn-success" type="submit">
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </div> <!-- // end row  -->
                                </form>
                            </div> <!-- End card-body -->
                        </div>
                    </div> <!-- end col -->
                </div>



            </div>
        </div>
    </div>

    {{-- javascript validation --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    }
                },
                messages: {
                    start_date: {
                        required: 'Please Select Start Date',
                    },
                    end_date: {
                        required: 'Please Select End Date',
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
