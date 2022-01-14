@extends('layout.app')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@push("style")
<style>
.navbar {
    width: 100%;
    padding: 10px;
    left: 0;
    position: initial;
}
</style>
@endpush

@section("content.header")
<header>
    <nav class="navbar navbar-brand navbar-light bg-light">
        <a class="navbar-brand" href="{{route('claim.view')}}">
            <!-- <img src="..." width="30" height="30" class="d-inline-block align-top" alt=""> -->
            CRM
        </a>
        <a class="btn btn-info" href="{{route('user.changepwd')}}">Change Password</a>
        <div class="d-flex bg-secondary p-2 gap-2">
            <p class="text-white">{{auth()->user()->name}} ||
            <p class="text-white d-block">{{auth()->user()->email}}</p>
            </p>

            <form action="{{route('user.logout')}}" method="POST">
                @csrf
                <button type="submit" class="btn-sm btn btn-secodary p-0" href="{{route('user.logout')}}">
                    <i class="log-out" data-feather="log-out"></i>
                </button>
            </form>
        </div>
    </nav>
</header>
@endsection
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
            <form action="{{route('user.change.password')}}" method="POST">
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



@push('plugin-scripts')

@endpush

@push('custom-scripts')

@endpush