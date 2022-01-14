<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class Users extends Component
{
    protected $listeners = ["userDeleted" => '$refresh'];
    public $search;

    public function getUsersProperty(){
        return User::withCount("claims")
                ->when($this->search >= 1, function ($query){
                    return $query->where("name", "LIKE", "%".$this->search."%")
                        ->orWhere("email", "LIKE", "%".$this->search."%");
                })
                ->latest()
                ->paginate(15);
    }

    public function delete(User $user){
        $this->dispatchBrowserEvent("openUserDeleteModal");
        $this->emit("setUserDelete", $user);
    }

    public function render()
    {
        return view('livewire.users');
    }
}