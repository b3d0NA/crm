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

.category-image {
    margin-bottom: 0px;
    position: relative;
}

.category-image .breadcrumb {
    position: absolute;
    left: 40px;
    padding: 0;
    top: 15px;
    font-size: 1.2rem;
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
        <div>
            @auth
            <a href="{{route('home')}}" class="btn btn-inverse-primary">Home</a>
            @endauth

            @guest
            <a href="{{route('user.login')}}" class="btn btn-primary">Login</a>
            @endguest
        </div>
    </nav>
    <div class="category-view">
        <div class="category-image">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class=" text-white" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('claim.view')}}">Quality Claim</a>
                    </li>
                </ol>
            </nav>
            <img src="https://dqwcrm8p9oclf.cloudfront.net/media/catalog/category/quality-claim.jpg" alt="Quality Claim"
                title="Quality Claim" class="image desktop-only"><img
                src="https://dqwcrm8p9oclf.cloudfront.net/media/catalog/category/quality-claim_1.jpg"
                alt="Quality Claim" title="Quality Claim" class="image mobile-only">
            <div class="absolute_overlay">
                <div class="_table">
                    <div class="_cell">
                        <h1>Quality Claim</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection
@section("content")
<!-- Image and text -->

<div class="container my-4">
    <div class="header-text my-6 mb-6 m-auto">
        <h2 class="card-title mb-lg-4 ">PLEASE COMPLETE THE FORM BELOW TO MAKE
            A PRODUCT QUALITY CLAIM</h2>
    </div>
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
    <form method="post" action="{{route('claim.store')}}" enctype="multipart/form-data" id="claimForm" class="m-auto">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="customerName" class="form-label">Customer Name*</label>
                    <input id="customerName" type="text" name="customer_name" required minlength="2"
                        class="form-control" placeholder="Enter customer name" value="{{old('customer_name')}}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Email*</label>
                    @guest
                    <input id="email" class="form-control" name="email" type="email" placeholder="Enter your email"
                        value="{{old('email')}}">
                    @endguest
                    @auth
                    <input id="email" readonly class="form-control" name="email" type="email"
                        value="{{auth()->user()->email}}">
                    @endauth
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="registeredBy" class="form-label">Registered by*</label>
                    <input name="registered_by" type="text" id="registeredBy" required minlength="2"
                        class="form-control" placeholder="Enter registered by name" value="{{old('registered_by')}}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="salesChannel" class="form-label">Sales channel*</label>
                    <select name="sales_channel" id="salesChannel" class="js-example-basic-single form-select"
                        data-width="100%" required value="{{old('sales_channel')}}">
                        @foreach ($channels as $channel)
                        <option value="{{$channel}}">{{$channel}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div><!-- Row -->
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="customerNumber">Customer number*</label>
                    <input id="customerNumber" type="number" name="customer_nr" required class="form-control"
                        placeholder="Enter customer number" value="{{old('customer_nr')}}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" id="customerCountry">Customer country*</label>
                    <select id="customerCountry" required name="customer_country"
                        class="js-example-basic-single form-select" data-width="100%"
                        value="{{old('customer_country')}}">
                        @foreach ($countries as $country)
                        <option value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="itemNumber">Item number*</label>
                    <select id="itemNumber" name="item_nr" class="js-example-basic-single form-select" data-width="100%"
                        value="{{old('item_nr')}}">
                        @foreach ($item_numbers as $item)
                        <option @if (old('item_nr')==$item) checked @endif value="{{$item}}">{{$item}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity*</label>
                    <input type="number" name="quantity" class="form-control" id="quantity" value="{{old('quantity')}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="purchasedDateInp">Purchased date*</label>
                    <div class="input-group date datepicker" id="purhcasedDate">
                        <input name="purchased_date" id="purchasedDateInp" type="text" class="form-control"
                            value="{{old('purchased_date')}}">
                        <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="serialNumber">Serial Number*</label>
                    <input id="serialNumber" name="serial_nr" type="text" class="form-control"
                        placeholder="Enter serial number" value="{{old('serial_nr')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="problemDescription">Problem description*</label>
                    <textarea name="problem_description" class="form-control" id="problemDescription"
                        rows="5">{{old('problem_description')}}</textarea>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="failureType">Failure type*</label>
                    <textarea name="failure_type" class="form-control" id="failureType"
                        rows="5">{{old('failure_type')}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="customerInvoiceNumber" class="form-label">Customer invoice
                        number*</label>
                    <input name="customer_invoice_number" id="customerInvoiceNumber" type="number" class="form-control"
                        value="{{old('customer_invoice_number')}}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="orderNumber">Customer Order number*</label>
                    <input name="customer_order_number" id="orderNumber" type="number" class="form-control"
                        value="{{old('customer_order_number')}}">
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="customerOrderDate">Order date*</label>
                    <div class="input-group date datepicker" id="orderDatePicker">
                        <input name="customer_order_date" id="customerOrderDate" type="text" class="form-control"
                            value="{{old('customer_order_date')}}">
                        <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="imageUpload">Image Upload* <sub class="text-google">Max:
                            1MB</sub></label>
                    <div class="input-group date datepicker" id="imageUpload">
                        <input value="{{old('image')}}" name="image[]" multiple="True" id=" imageUpload" type="file"
                            class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary submit">Claim</button>

</div>
</form>
</div>
</div>
</div>
@endsection



@push('plugin-scripts')
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush