<?php

namespace App\Http\Livewire;

use App\Claim;
use Livewire\Component;

class ClaimView extends Component
{
    protected $listeners = ["setClaimView"];

    public $claim;
    public $isModalOpen=false;

    public function setClaimView(Claim $claim){
        $this->isModalOpen = true;
        $this->claim = $claim;
    }

    public function render()
    {
        return view('livewire.claim-view');
    }
}