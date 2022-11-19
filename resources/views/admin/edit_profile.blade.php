@extends('admin.admin_master')
@section('admin')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <div class="card" style=" margin-top:7rem; ">
                <div class="card-header">
                    <div class="card-title">Edit Profile</div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('store.profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center chat-image mb-5">
                            <div class="avatar-list">
                                <img alt="avatar"
                                    src="{{ !empty($editData->profile_image) ? url('upload/admin_images/' . $editData->profile_image) : url('upload/22.jpg') }}"
                                    class="brround avatar avatar-xxl" id="showImage"
                                    style="margin-right:-1rem; margin-bottom:1rem;">
                            </div>
                            <div class="main-chat-msg-name">
                                <a href={{ route('admin.profile') }}>
                                    <h5 class="mb-1 text-dark fw-semibold">{{ $editData->name }}</h5>
                                </a>
                                <p class="text-muted mt-0 mb-0 pt-0 fs-13">{{ $editData->email }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Name</span>
                                <input type="text" name="name" class="form-control" aria-label="Username"
                                    aria-describedby="basic-addon1" value="{{ $editData->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Email</span>
                                <input type="email" class="form-control" name="email" aria-label="Username"
                                    aria-describedby="basic-addon1" value="{{ $editData->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formFile" class="form-label mt-0">Upload Profile</label>
                            <input class="form-control" type="file" name="profile_image" id="image">
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
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
