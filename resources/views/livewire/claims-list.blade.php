<div>
    <div class="row">
        <div class="col-md-3">
            <input wire:model.debounce.500ms="search" class="form-control me-2" type="search" placeholder="Search"
                aria-label="Search">
        </div>
        <div class="col-md-1">
            <select wire:model="priority" id="" class="form-select">
                <option selected value="0">Priority</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
        </div>
        <div class="col-md-1">
            <select wire:model="decision" id="" class="form-select">
                <option selected value="0">Decision</option>
                <option selected value="pending">Pending</option>
                @foreach ($collectedDecisions as $decision)
                <option value="{{$decision}}">{{$decision}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select wire:model="escalation" id="" class="form-select">
                <option selected value="0">No Escalation</option>
                <option selected value="1">Escalated</option>
                <option selected value="2">User Escalated</option>
            </select>
        </div>
    </div>
    <div class="table-responsive mb-3">
        <table id="claimList" class="table">
            <thead>
                <tr>
                    <th>Claim No</th>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Registered By</th>
                    <th>Quantity</th>
                    <th>Failure type</th>
                    <th>Problem description</th>
                    <th>Decision</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($claims as $claim)
                <tr @class(['alert-danger'=> $claim->is_escalated >= 2, 'alert-warning'=>$claim->is_escalated == 1])>
                    <td>{{$claim->claim_no}}</td>
                    <td>{{$claim->date->format("Y/m/d")}}</td>
                    <td>{{$claim->customer_name}}</td>
                    <td>{{$claim->registered_by}}</td>
                    <td>{{$claim->quantity}}</td>
                    <td>{{Str::limit($claim->failure_type, 15, '...')}}</td>
                    <td>{{Str::limit($claim->problem_description, 20, '...')}}</td>
                    <td>
                        <select onchange="emitDecisionChanged({{$claim->id}}, this.value)" id="decisionSelect" class="
                                    btn text-white cursor-default bg-primary form-select
                                    {{$claim->decisionBg($claim->decision)[0]}}
                                ">
                            @foreach (config('app.decisions') as $decision)
                            <option style="background-color: #fff;color:#000" @if ($decision==$claim->decision)
                                selected
                                @endif value="{{$decision}}">
                                {{$decision}}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button wire:click.prevent="view({{$claim->id}})" class="btn btn-sm btn-info">
                            <span wire:loading wire:target="view({{$claim->id}})"
                                class="spinner-border spinner-border-sm text-light" role="status"
                                aria-hidden="true"></span>
                            <span wire:loading.remove wire:target="view({{$claim->id}})">View</span>
                        </button>
                        <a href="{{route('claims.edit', $claim)}}" class="btn btn-sm btn-primary">Edit</a>
                        <button wire:click.prevent="delete({{$claim->id}})" class="btn btn-sm btn-danger">
                            <span wire:loading wire:target="delete({{$claim->id}})"
                                class="spinner-border spinner-border-sm text-light" role="status"
                                aria-hidden="true"></span>
                            <span wire:loading.remove wire:target="delete({{$claim->id}})">Delete</span>
                        </button>
                    </td>
                </tr>
                @empty
                <td class="text-center" colspan="9">No data found!</td>
                @endforelse
            </tbody>
        </table>
    </div>
    {{$claims->links()}}
</div>