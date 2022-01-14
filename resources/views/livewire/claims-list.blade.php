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
                    </td>
                    <td>
                        <button wire:click.prevent="view({{$claim}})" class="btn btn-sm btn-info">View</button>
                        <a href="{{route('claims.edit', $claim)}}" class="btn btn-sm btn-primary">Edit</a>
                        <button wire:click.prevent="delete({{$claim}})" class="btn btn-sm btn-danger">Delete</button>
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