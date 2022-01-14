<div>
    @foreach ($errors->all() as $error)
    <div class="bg-danger p-3 text-white">
        {{$error}}
    </div>
    @endforeach
    <div class="row my-2">
        <div class="col-md-3">
            <input wire:model.debounce.500ms="search" class="form-control me-2" type="search" placeholder="Search"
                aria-label="Search">
        </div>
        <div wire:ignore class="col-md-6 d-flex gap-3">
            <a href="{{route('items.create')}}" class="btn btn-primary" id="addItemBtn">
                <i class="link-icon mx-1" data-feather="file"></i>
                <span>Add Item</span>
            </a>
            <a href="{{route('items.csv.view')}}" class="btn btn-secondary" id="csvBtn">
                <i class="link-icon mx-1" data-feather="file"></i>
                <span>Import CSV</span>
            </a>
            <form>
            </form>
        </div>
    </div>
    <div class="table-responsive mb-3">
        <table id="claimList" class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Number</th>
                    <th>Description</th>
                    <th>Group</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->items as $item)
                <tr @class([ 'bg-light'=> $loop->even])>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->number}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->group->code}}</td>
                    <td>
                        <button wire:click.prevent="delete({{$item->id}})" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">
                        <p>No data found!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{$this->items->links()}}
</div>