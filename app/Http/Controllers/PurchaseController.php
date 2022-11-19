<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\purchase;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\unit;
use App\Models\supplier;
use Illuminate\Support\Facades\Auth;
class PurchaseController extends Controller
{
    //


    public function PurchaseAll(Request $request){
        $allData = purchase::orderBy('date', 'desc')->orderBy('id','desc')->get();
        //The compact() function is used to convert given variable to to array in which the key of the array will be the name of the variable and the value of the array will be the value of the variable
        return view('admin.purchase_all', compact('allData'));
    }

    public function PurchaseAdd(){

        $supplier = supplier::all();
        $category = Category::all();
        $unit = unit::all();
        $date = date('Y-m-d');
        return view('admin.purchase_add',compact('supplier','category','unit', 'date'));
    }

    public function PurchaseStore(Request $request){

        if ($request->category_id == null) {

           $notification = array(
            'message' => 'Sorry you do not select any item',
            'alert-type' => 'error'
        );
        return redirect()->back( )->with($notification);
        } else {

            $count_category = count($request->category_id);
            for ($i=0; $i < $count_category; $i++) {
                $purchase = new Purchase();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];

                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];

                $purchase->created_by = Auth::user()->id;
                $purchase->status = '0';
                $purchase->save();
            } // end foreach
        } // end else

        $notification = array(
            'message' => 'Data Save Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('purchase.all')->with($notification);
        } // End Method


        public function PurchaseDelete($id){

            Purchase::findOrFail($id)->delete();

             $notification = array(
            'message' => 'Purchase Iteam Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

        } // End Method


        public function PurchasePending(){

            $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
            return view('admin.purchase_pending',compact('allData'));
        }// End Method


        public function PurchaseApprove($id){

            $purchase = Purchase::findOrFail($id);
            $product = Product::where('id',$purchase->product_id)->first();
            $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
            $product->quantity = $purchase_qty;

            if($product->save()){

                Purchase::findOrFail($id)->update([
                    'status' => '1',
                ]);
                 $notification = array(
            'message' => 'Purchase Approved Successfully',
            'alert-type' => 'success'
              );
        return redirect()->route('purchase.all')->with($notification);

            }

        }


        public function PurchaseReport(){
            return view('admin.purchase_report');
        }

        public function PurchaseReportPdf(Request $request){

            $sdate = date('Y-m-d',strtotime($request->start_date));
            $edate = date('Y-m-d',strtotime($request->end_date));
            $allData = purchase::whereBetween('date',[$sdate,$edate])->where('status', '1')->get();

            $start_date = date('Y-m-d',strtotime($request->start_date));
            $end_date = date('Y-m-d',strtotime($request->end_date));

            return view('admin.purchase_report_pdf',compact('allData', 'start_date', 'end_date'));

        }

}
