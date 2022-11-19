<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\unit;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class UnitController extends Controller
{
    //


    public function UnitAll(){

        $unit = unit::latest()->get();
        return view('admin.unit_all',compact('unit'));
    }

    public function UnitAdd(){
        return view('admin.unit_add');
    }

    public function UnitStore(Request $request){
        unit::insert([
            'unit'=> $request->unit,
            'created_by'=> Auth::user()->id,
            'created_at'=> Carbon::now(),
        ]);
        $notification = array('message' =>'Unit Inserted Successfully',
        'alert-type' => 'success');

        return redirect()->route('unit.all')->with($notification);
    }

    public function UnitEdit($id){
        $unit = unit::findorFail($id);
        return view('admin.unit_edit', compact('unit'));
    }

    public function UnitUpdate(Request $request){

        $unit_id = $request->id;

        unit::findOrFail($unit_id)->update([
            'unit' => $request->unit,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Unit Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);

    }

    public function UnitDelete($id){

        unit::findOrFail($id)->delete();

         $notification = array(
              'message' => 'Unit Deleted Successfully',
              'alert-type' => 'success'
          );

          return redirect()->back()->with($notification);

      }
}
