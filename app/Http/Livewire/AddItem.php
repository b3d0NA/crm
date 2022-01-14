<?php

namespace App\Http\Livewire;

use App\ItemGroup;
use Livewire\Component;

class AddItem extends Component
{
    public $groups;

    public $number;
    public $description;
    public $group;
        
    protected $rules = [
        "number" => "required|min:1",
        "description" => "required|min:2",
        "group" => "required",
    ];

    public function mount($groups)
    {
        $this->groups = $groups;
    }

    public function store(){
        $this->validate();
        
        $itemGroup = ItemGroup::firstOrCreate([
            "code" => $this->group
        ], [
            "code" => $this->group
        ]);
        $itemGroup->items()->create([
            "number" => $this->number,
            "description" => $this->number
        ]);
        $this->dispatchBrowserEvent("itemCreatedSuccessfully");
    }


    public function render()
    {
        return view('livewire.add-item');
    }
}