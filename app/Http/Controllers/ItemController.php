<?php

namespace App\Http\Controllers;

use App\CsvData;
use App\Http\Requests\CsvImportRequest;
use App\Http\Requests\ItemRequest;
use App\Item;
use App\ItemGroup;
use Exception;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){
        return view("pages.items.index");
    }

    public function create(){
        $groups = ItemGroup::latest()->pluck("code");
        return view("pages.items.create", compact("groups"));
    }

    public function store(ItemRequest $request){
        $itemGroup = ItemGroup::firstOrCreate([
            "code" => $request->group
        ], [
            "code" => $request->group
        ]);
        $itemGroup->items()->create([
            "number" => $request->number,
            "description" => $request->description
        ]);
        return redirect()->route("items.index");
    }

    public function getImport()
    {
        return view("pages.items.import");
    }

    public function parseImport(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        $csv_data_file = CsvData::create([
            'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
            'csv_header' => $request->has('header'),
            'csv_data' => json_encode($data)
        ]);

        $csv_data = array_slice($data, 0, 5);
        return view('pages.items.import_fields', compact('csv_data', 'csv_data_file'));
    }

    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        try{
            foreach ($csv_data as $row) {
                if($row[0] === "No."|| $row[1] === "Item Description"){continue;}
                $itemGroup = ItemGroup::firstOrCreate([
                    "code" => (int) $row[2]
                ], [
                    "code" => (int) $row[2]
                ]);
                $item = new Item();
                foreach (["number", "description"] as $index => $field) {
                    $item->$field = $row[$request->fields[$index]];
                }
                $item->group_id = $itemGroup->id;
                $item->save();
            }
        }catch(Exception $e){
            return redirect()
                    ->route("items.csv.view")
                    ->withErrors(["Something wrong happend! Please try again later"]);
        }
        CsvData::query()->delete();
        return redirect()->route("items.index");
    }
}