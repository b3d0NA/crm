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
    </div>
    <div class="table-responsive mb-3">
        <table id="claimList" class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Claims Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->users as $user)
                <tr @class([ 'bg-light'=> $loop->even])>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->claims_count}}</td>
                    <td>
                        <button wire:click.prevent="delete({{$user->id}})" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">
                        <p>No user found!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{$this->users->links()}}
</div>