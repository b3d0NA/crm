<?php

namespace App\Http\Livewire;

use App\Item;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Items extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $csvFile;
    public $excelFile;

    protected $listeners = ["itemCreatedSuccessfully" => '$refresh'];

    public function getItemsProperty(){
        return Item::with("group")
                ->when($this->search >= 1, function ($query){
                    return $query->where("number", "LIKE", "%".$this->search."%")
                        ->orWhere("description", "LIKE", "%".$this->search."%");
                })
                ->latest()
                ->paginate(15);
    }


    public function delete($id){
        return Item::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.items');
    }
}