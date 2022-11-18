<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Color;
use App\Models\Manufacturer;
use App\Models\Type;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getcars(Request $request){
        if ($request->data == null || $request->data == ''){
            $color = Cars::select('id','name','manufacturer','type','color')->with('manufacturer','type','color')->paginate(20);
        }else {
            $color = Cars::select('id','name','manufacturer','type','color')->where('name', 'LIKE', '%'.$request->data.'%')->with('manufacturer','type','color')->paginate(20);
        }
        return response()->json( $color);
    }

    public function addcars(Request $request){
        $request->validate([
            'name' => 'required',
            'manufacturer' => 'required',
            'type' => 'required',
            'color' => 'required',
        ]);

        $color = new Cars;
        $color->name = $request->name;
        $color->manufacturer = $request->manufacturer['id'];
        $color->type = $request->type['id'];
        $color->color = $request->color['id'];
        $color->save();

        return response()->json([
            'message' => 'Car successfully added.'
        ]);
    }

    public function deletecars(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $a = Cars::where('id', $request->id)->first();
        Cars::where('id', $request->id)->delete();
        return response()->json([
            'message' => 'Successfully deleted '.$a->name
        ]);

    }

    public function optionscar(Request $request){
        $optionsM = Manufacturer::select('id','name')->get();
        $optionsT = Type::select('id','name')->get();
        $optionsC = Color::select('id','name','colorcode')->get();
        return response()->json([
            'optionsM' => $optionsM,
            'optionsT' => $optionsT,
            'optionsC' => $optionsC
        ]);
    }
}
