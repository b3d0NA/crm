<?php

namespace App\Http\Livewire;

use App\Claim;
use App\ItemGroup;
use Livewire\Component;

class ClaimEdit extends Component
{
    protected $listeners = ["setClaimEdit"];

    public $isModalOpen = false;

    public $groups;

    public $notes;
    public $decision;
    public $product_group;
    public $priority;
    public $inspection_results;
    public $actions;
    public $supplier;
    public $assembled;
    public $is_returned;
    public $is_returned_to_sales;

    public function setClaimEdit(Claim $claim){
        $this->groups = ItemGroup::latest()->pluck("code");
        $this->fill($claim);
        $this->isModalOpen = true;
    }

    public function render()
    {
        return view('livewire.claim-edit');
    }
}