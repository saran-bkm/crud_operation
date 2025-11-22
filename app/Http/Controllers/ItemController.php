<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemsImport;

class ItemController extends Controller
{
    
    public function index()
    {
        $items = Item::with('orderDetails')->paginate(10);
        return view('items.index', compact('items'));
    }
    
    public function add(){
        return view('items.add');
    }

    public function edit($id)
    {
        $items = Item::find($id);

        if (!$items) {
            return redirect()->route('items')
                ->with('error', 'Item not found!');
        }

        return view('items.edit', compact('items'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'sku'   => 'required|string|max:255|unique:items,sku',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $item = Item::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Item created successfully!',
            'item' => $item
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'sku'   => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [
            "name" => $request->name,
            "sku" => $request->sku,
            "price" => $request->price,
            "stock" => $request->stock
        ];

        $item = Item::where('id',$request->id)->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Item udpate successfully!',
            'item' => $item
        ]);
    }

    public function bulkUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,csv'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        Excel::import(new ItemsImport, $request->file('file'));

        return response()->json([
            'status' => true,
            'message' => 'Bulk Upload Completed Successfully!'
        ], 200);
    }

}
