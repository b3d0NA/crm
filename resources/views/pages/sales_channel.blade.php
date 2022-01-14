@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @foreach ($errors->all() as $error)
                <div class="bg-danger p-3 text-white">
                    {{$error}}
                </div>
                @endforeach
                <h6 class="card-title text-center">
                    Sales Channel
                </h6>
                <form action="{{route('sales.store')}}" method="POST">
                    @csrf
                    <div class="row my-2">
                        <div class="col-md-3">
                            <input class="form-control me-2" name="country" type="text" placeholder="Add sales channel"
                                aria-label="Search">
                        </div>
                        <div class="col-sm-1">
                            <input class="form-control me-2 bg-secondary text-white" type="submit" value="Add"
                                aria-label="Search">
                        </div>
                    </div>
                </form>
                <div>
                    <div class="table-responsive mb-3">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($channels as $channel)
                                <tr @class([ 'bg-light'=> $loop->even])>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$channel->country}}</td>
                                    <td>
                                        <a href="{{route('sales.delete', $channel->id)}}"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">
                                        <p>No data found!</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<livewire:claim-edit />
<livewire:claim-delete />
@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush