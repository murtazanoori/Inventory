<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\unit;
use App\Models\supplier;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function ProductAll(){

        $product = Product::with('supplier_details','category_details', 'unit_details')->get();

        return view('admin.product_all',compact('product'));
    }

    public function ProductAdd(){

        $supplier = supplier::all();
        $category = Category::all();
        $unit = unit::all();
        return view('admin.product_add',compact('supplier','category','unit'));
    }

    public function ProductStore(Request $request){

        Product::insert([

            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'quantity' => '0',
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);

    }


    public function ProductEdit($id){

        $supplier = supplier::all();
        $category = Category::all();
        $unit = unit::all();
        $product = Product::findOrFail($id);
        return view('admin.product_edit',compact('product','supplier','category','unit'));
    }


    public function ProductUpdate(Request $request){

        $product_id = $request->id;

        Product::findOrFail($product_id)->update([

            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);
    }

    public function ProductDelete($id){

        Product::findOrFail($id)->delete();

         $notification = array(
              'message' => 'Product Deleted Successfully',
              'alert-type' => 'success'
          );

          return redirect()->back()->with($notification);

      }
}
