<?php

namespace App\Http\Livewire;

use App\Claim;
use Livewire\Component;

class ClaimDelete extends Component
{
    protected $listeners = ["setClaimDelete"];

    public $isModalOpen = false;
    public $claim;
    
    public function setClaimDelete(Claim $claim){
        $this->isModalOpen = true;
        $this->claim = $claim;
    }
    
    public function delete(){
        $this->claim->delete();
        $this->isModalOpen = false;
        $this->dispatchBrowserEvent("closeClaimDeleteModal");
        $this->emit("claimDeleted");
    }

    public function render()
    {
        return view('livewire.claim-delete');
    }
}