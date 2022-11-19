<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class SupplierController extends Controller
{
    //
    public function SupplierAll(){

        // $suppliers = Supplier::all();
        $suppliers = Supplier::latest()->get();
        return view('admin.supplier_all',compact('suppliers'));
    }

    public function SupplierAdd(){
        return view('admin.supplier_add');
    }

    public function SupplierStore(Request $request){
        Supplier::insert([
            'name'=> $request->name,
            'lname'=> $request->lname,
            'mobile_no'=> $request->mobile_no,
            'address'=> $request->address,
            'created_by'=> Auth::user()->id,
            'created_at'=> Carbon::now(),
        ]);
        $notification = array('message' =>'Supplier Inserted Successfully',
        'alert-type' => 'success');

        return redirect()->route('supplier.all')->with($notification);
    }

    public function SupplierEdit($id){
        $supplier = Supplier::findorFail($id);
        return view('admin.supplier_edit', compact('supplier'));
    }

    public function SupplierUpdate(Request $request){

        $sullier_id = $request->id;

        Supplier::findOrFail($sullier_id)->update([
            'name' => $request->name,
            'lname' => $request->lname,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Supplier Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('supplier.all')->with($notification);

    }

    public function SupplierDelete($id){

        Supplier::findOrFail($id)->delete();

         $notification = array(
              'message' => 'Supplier Deleted Successfully',
              'alert-type' => 'success'
          );

          return redirect()->back()->with($notification);

      }
}
