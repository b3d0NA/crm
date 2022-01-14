@extends('layout.app')


@section("content.header")
<header>
    <nav class="navbar navbar-brand navbar-light bg-light">
        <a class="navbar-brand" href="{{route('claim.view')}}">
            CRM
        </a>
    </nav>
</header>
@endsection

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

@section('content')
<div class="page-content mt-6 d-flex align-items-center justify-content-center">
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-6 col-xl-5 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="auth-form-wrapper px-4 py-5">
                            <p class="noble-ui-logo d-block mb-2">CRM User Login</p>
                            <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                            @if (session("login.error"))
                            <div class="alert alert-danger" role="alert">
                                <i data-feather="alert-circle"></i>
                                {{session("login.error")}}
                            </div>
                            @endif
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                <i data-feather="alert-circle"></i>
                                {{$error}}
                            </div>
                            @endforeach
                            <form class="forms-sample" method="POST" action="{{route('user.login')}}">
                                @csrf
                                <div class="mb-3">
                                    <label for="userEmail" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="userEmail"
                                        value="{{old('email')}}" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <label for="userPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="userPassword"
                                        autocomplete="current-password" placeholder="Password">
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="authCheck" name="remember">
                                    <label class="form-check-label" for="authCheck">
                                        Remember me
                                    </label>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-primary me-2 mb-2 mb-md-0" value="Login">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection