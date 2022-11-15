<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function gettypes(Request $request){
        if ($request->data == null || $request->data == ''){
            $types = Type::select('id','name')->paginate(20);
        }else {
            $types = Type::select('id','name')->where('name', 'LIKE', '%'.$request->data.'%')->paginate(20);
        }
        return response()->json($types);
    }

    public function addtypes(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $type = new Type;
        $type->name = $request->name;
        $type->save();

        return response()->json([
            'message' => 'Type successfully add.'
        ]);
    }

    public function deletetypes(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $a = Type::where('id', $request->id)->first();
        Type::where('id', $request->id)->delete();
        return response()->json([
            'message' => 'Successfully deleted '.$a
        ]);

    }

}
