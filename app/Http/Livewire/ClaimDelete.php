<?php

namespace App\Http\Livewire;

use App\Claim;
use Illuminate\Support\Facades\File;
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
        $images = $this->claim->image;
        foreach(explode("|", str_replace("public", "", $images)) as $image){
            File::exists($image);
        }
        // if(File::exists($image_path)) {
        //     File::delete($image_path);
        // }
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