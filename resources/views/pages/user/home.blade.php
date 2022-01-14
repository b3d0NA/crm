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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{route('claim.view')}}">
            <!-- <img src="..." width="30" height="30" class="d-inline-block align-top" alt=""> -->
            CRM
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-item nav-link" href="{{route('user.changepwd')}}">Change Password</a>
                </li>
            </ul>
        </div>
        <div class="d-flex bg-secondary p-2 gap-2 form-inline my-2 my-lg-0">
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
    @foreach ($claims as $claim)
    <div class="row mt-2">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-header">
                    Item number: {{$claim->item_nr}} || Customer Number: {{$claim->customer_nr}} || Order number:
                    {{$claim->customer_order_number}}
                </div>
                <div class="card-body bg-light">
                    <p>Problem Description: {{$claim->problem_description}} </p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        @foreach (explode("|", str_replace("public", "", $claim->image)) as $image)
                        <img src="{{asset('storage/'.$image)}}" alt="{{$image}}"
                            style=" width: 30%;height: 30%; border-radius: 10px">
                        @endforeach
                    </div>
                    <p>{{now()->diffInDays($claim->created_at) >= 14}}</p>
                    @if (now()->diffInDays($claim->created_at) >= 14 && !empty($claim->decision))
                    <a href="{{route('claims.escalatebyuser', $claim)}}" class="btn btn-danger float-end my-2">Escalate
                        the
                        claim</a>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="d-flex flex-column text-center">
                                <p>Decision:</p>
                                <p href="#" class="
                                    btn text-white cursor-default bg-primary
                                    @if (in_array($claim->decision, ['approved', 'Approved', 'approve', 'Approve']))
                                    bg-success
                                    @elseif (in_array($claim->decision, ['not-approved', 'not approved', 'Not approved', 'Not Approved', 'Declined', 'declined']))
                                    bg-danger
                                    @elseif(!empty($claim->decision))
                                    bg-warning
                                    @endif
                                ">
                                    @if (!$claim->decision)
                                    Pending...
                                    @else
                                    {{$claim->decision}}
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if ($claim->is_escalated >= 1)
                        <div class="col-md-3">
                            <div class="d-flex flex-column text-center">
                                <p>Escalation:</p>
                                <p href="#" class="btn btn-danger">
                                    @if ($claim->is_escalated == 1)
                                    Escalated to admin after 14 days
                                    @else
                                    Highlighted to Admin!
                                    @endif
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection



@push('plugin-scripts')

@endpush

@push('custom-scripts')

@endpush