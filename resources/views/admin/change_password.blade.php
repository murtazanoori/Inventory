@extends('admin.admin_master')
@section('admin')

    <div class="main-content app-content mt-0">
        <div class="side-app">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <div class="card" style=" margin-top:7rem; ">
                <div class="card-header">
                    <div class="card-title">Change Password</div>
                </div>
                @php
                    $id = Auth::user()->id;

                    //finding which user is logged in ?
                    $editData = App\Models\User::find($id);

                @endphp
                <div class="card-body">

                    @if (count($errors))
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger alert-dismissible fade show"> {{ $error }} </p>
                        @endforeach
                    @endif

                    <form method="post" action="{{ route('update.password') }}">
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
                                <span class="input-group-text" id="oldpassword">Old Password</span>
                                <input type="password" name="oldpassword" class="form-control" aria-label="Username"
                                    aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="newpassword">New Password</span>
                                <input type="password" class="form-control" name="newpassword" aria-label="Username"
                                    aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="confirm_password">Confirm Password</span>
                                <input type="password" class="form-control" name="confirm_password" aria-label="Username"
                                    aria-describedby="basic-addon1">
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

@endsection
