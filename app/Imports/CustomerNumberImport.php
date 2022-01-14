<?php

namespace App\Imports;

use App\CustomerNumber;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomerNumberImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try{
            return new CustomerNumber([
                'number' => (int) $row[0]
            ]);
        }catch(Exception $e){
            return redirect()->back()->withErrors(["msg" => $e]);
        }
            
    }
}