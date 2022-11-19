@extends('admin.admin_master')
@section('admin')

    <div class="page">
        <div class="page-main">
            <div class="card" style="width:50%; margin-left:31rem; margin-top:7rem; ">
                <div class="card-header">
                    <div class="card-title">Profile</div>
                </div>
                <div class="card-body">
                    <div class="text-center chat-image mb-5">
                        <div class="avatar avatar-xxl chat-profile mb-3 brround">
                            <a><img alt="avatar"
                                    src="{{ !empty($adminData->profile_image) ? url('upload/admin_images/' . $adminData->profile_image) : url('upload/22.jpg') }}"
                                    class="brround"></a>
                        </div>
                    </div>
                    <div class="form-group">

                        <h4 class="mb-1 text-dark fw-semibold">Name : {{ $adminData->name }}</h4>
                        <hr style="border-top: 1px solid black;">
                    </div>
                    <div class="form-group">
                        <h4 class="mb-1 text-dark fw-semibold">Email : {{ $adminData->email }}</h4>
                        <hr style="border-top: 1px solid black;">
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.edit_profile') }}" class="btn btn-success">Edit</a>

                </div>
            </div>

        </div>
    </div>
        @endsection
