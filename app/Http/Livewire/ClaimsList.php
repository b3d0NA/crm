<?php

namespace App\Http\Livewire;

use App\Claim;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class ClaimsList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $priority;
    public $decision;
    public $collectedDecisions;
    public $escalation;

    protected $listeners = ["claimDeleted" => '$refresh', "claimUpdated" => '$refresh'];

    public function mount($decisions){
        $this->collectedDecisions = $decisions;
    }

    public function getClaimsProperty(){
        return Claim::with("user")
                    ->when($this->search >= 2 , function ($query){
                        foreach(Schema::getColumnListing('claims') as $column){
                            $query->orWhere($column, 'LIKE', '%' . $this->search . '%');
                        }
                        return $query;
                    })
                    ->when($this->priority, function ($query){
                        return $query->where("priority", $this->priority);
                    })
                    ->when($this->decision, function ($query){
                        if($this->decision === "pending"){
                            $query->whereNull("decision");
                        }else{
                            $query->where("decision", 'LIKE', '%'.$this->decision.'%');
                        }
                        return $query;
                    })
                    ->when($this->escalation, function ($query){
                        return $query->where("is_escalated", $this->escalation);
                    })
                    ->latest()
                    ->paginate(15);
    }
    public function delete(Claim $claim){
        $this->dispatchBrowserEvent("openClaimDeleteModal");
        $this->emit("setClaimDelete", $claim);
    }

    public function view(Claim $claim){
        $this->dispatchBrowserEvent("openClaimViewModal");
        $this->emit("setClaimView", $claim);
    }

    public function edit(Claim $claim){
        $this->dispatchBrowserEvent("openClaimEditModal");
        $this->emit("setClaimEdit", $claim);
    }

    public function render()
    {
        return view('livewire.claims-list', [
            "claims" => $this->claims,
        ]);
    }
}