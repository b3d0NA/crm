<?php

namespace App\Imports;

use App\ItemNumber;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class ItemNumberImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try{
            return new ItemNumber([
                'number' => (int) $row[0]
            ]);
        }catch(Exception $e){
            return redirect()->back()->withErrors(["msg" => $e]);
        }
    }
}