<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MstItem;
use App\Models\MstItemType;
use App\Models\MstUser;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function getItems()
    {
        return response()->json(MstItem::all());
    }

    public function getItemTypes()
    {
        return response()->json(MstItemType::all());
    }

    public function getUsers()
    {
        return response()->json(MstUser::all());
    }

    public function createItem(Request $request)
    {
        $request->validate([
            'item_code' => 'required',
            'item_type_id' => 'required',
            'name' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $item = MstItem::create([
            'item_code' => $request->item_code,
            'item_type_id' => $request->item_type_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'created_by' => auth()->id(),
        ]);

        return response()->json($item, 201);
    }

    public function createItemType(Request $request)
    {
        $request->validate(['name' => 'required']);

        $itemType = MstItemType::create([
            'name' => $request->name,
            'created_by' => auth()->id(),
        ]);

        return response()->json($itemType, 201);
    }
}
