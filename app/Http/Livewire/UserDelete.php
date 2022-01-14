<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class UserDelete extends Component
{
    protected $listeners = ["setUserDelete"];

    public $isModalOpen = false;
    public $user;

    public function setUserDelete(User $user){
        $this->isModalOpen = true;
        $this->user = $user;
    }
    
    public function delete(){
        $this->user->delete();
        $this->isModalOpen = false;
        $this->dispatchBrowserEvent("closeUserDeleteModal");
        $this->emit("userDeleted");
    }
    
    public function render()
    {
        return view('livewire.user-delete');
    }
}