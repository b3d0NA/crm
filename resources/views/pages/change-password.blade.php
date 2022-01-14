@extends('layout.master')

@section("content")
<div class="container my-4">
    <div class="card">
        <div class="card-body">

            <h5 class="card-title text-center">Change Password</h5>
            @foreach ($errors->all() as $error)
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <div class="alert alert-fill-danger" role="alert">
                            {{$error}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <form action="{{route('admin.change.password')}}" method="POST">
                @csrf
                <div class="row mt-2">
                    <div class="col-md-12 stretch-card">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">Current Password*</label>
                                <input id="currentPassword" type="password" name="current_password" required
                                    minlength="2" class="form-control" placeholder="Enter current password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12 stretch-card">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">New Password*</label>
                                <input id="newPassword" type="password" name="new_password" required minlength="2"
                                    class="form-control" placeholder="Enter new password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12 stretch-card">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="confirmNewPassword" class="form-label">Confirm New Password*</label>
                                <input id="confirmNewPassword" type="password" name="new_confirm_password" required
                                    minlength="2" class="form-control" placeholder="Confirm new password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12 stretch-card">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <input type="submit" name="change" value="Change" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

