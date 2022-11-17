<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getmanufacturers(Request $request){
        if ($request->data == null || $request->data == ''){
            $manu = Manufacturer::select('id','name')->paginate(20);
        }else {
            $manu = Manufacturer::select('id','name')->where('name', 'LIKE', '%'.$request->data.'%')->paginate(20);
        }
        return response()->json($manu);
    }

    public function addmanufacturers(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $manu = new Manufacturer;
        $manu->name = $request->name;
        $manu->save();

        return response()->json([
            'message' => 'Type successfully add.'
        ]);
    }

    public function deletemanufacturers(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $a = Manufacturer::where('id', $request->id)->first();
        Manufacturer::where('id', $request->id)->delete();
        return response()->json([
            'message' => 'Successfully deleted '.$a->name
        ]);

    }
}
