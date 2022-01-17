<?php

namespace App\Http\Livewire;

use App\Claim;
use Livewire\Component;

class DecisionUpdate extends Component
{
    protected $listeners = ["setDecisionUpdate"];
    public $claim;
    public $decision;

    public function setDecisionUpdate($value){
        $this->claim = $value["id"];
        $this->decision = $value["value"];
    }

    public function update(){
        $claim = Claim::findOrFail($this->claim);
        $claim->update(["decision" => $this->decision]);
        $this->dispatchBrowserEvent("decisionUpdated");
        $this->emit("decisionUpdated");
    }

    public function render()
    {
        return view('livewire.decision-update');
    }
}