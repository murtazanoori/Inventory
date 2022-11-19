<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\unit;
use App\Models\supplier;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class StockController extends Controller
{
    //
    public function StockReport(){
        $allData = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        return view('Stock.stock_report', compact('allData'));
    }

    public function StockReportPdf(){
        $allData = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        return view('Stock.stock_report_pdf', compact('allData'));
    }

    public function StockSupplier(){
        $supplier = supplier::all();
        $category = Category::all();
        return view('Stock.supplier_report',compact('supplier','category'));
    }

    public function StockSupplierPdf(Request $request){
        $allData = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->where('supplier_id', $request->supplier_id)->get();
        return view('Stock.supplier_report_pdf', compact('allData'));
    }

    public function StockProductPdf (Request $request){
        $product = Product::where('category_id',$request->category_id)->where('id',$request->product_id )->first();
        return view('Stock.product_report_pdf', compact('product'));
    }


}
