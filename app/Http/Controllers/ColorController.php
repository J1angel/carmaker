<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getcolors(Request $request){
        if ($request->data == null || $request->data == ''){
            $color = Color::select('id','name','colorcode')->paginate(20);
        }else {
            $color = Color::select('id','name','colorcode')->where('name', 'LIKE', '%'.$request->data.'%')->paginate(20);
        }
        return response()->json( $color);
    }

    public function addcolors(Request $request){
        $request->validate([
            'name' => 'required',
            'color' => 'required'
        ]);

        $color = new Color;
        $color->name = $request->name;
        $color->colorcode = $request->color;
        $color->save();

        return response()->json([
            'message' => 'Color successfully added.'
        ]);
    }

    public function deletecolors(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $a = Color::where('id', $request->id)->first();
        Color::where('id', $request->id)->delete();
        return response()->json([
            'message' => 'Successfully deleted '.$a->name
        ]);

    }
}
