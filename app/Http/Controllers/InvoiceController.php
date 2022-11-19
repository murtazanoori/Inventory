<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\invoiceDetail;
use App\Models\payment;
use App\Models\paymentDetail;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice_detail;


class InvoiceController extends Controller
{
    //

    public function InvoiceAll()
    {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();

        return view('admin.invoice_all', compact('allData'));
    } // End Method


    public function InvoiceAdd()
    {


        $category = Category::all();
        $customer = Customer::all();
        $invoice_data = Invoice::orderBy('id', 'desc')->first();
        if ($invoice_data == null) {
            $firstReg = '0';
            $invoice_no = $firstReg + 1;
        } else {
            $invoice_data = Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $invoice_no = $invoice_data + 1;
        }
        $date = date('Y-m-d');
        return view('admin.invoice_add', compact('invoice_no', 'category', 'date', 'customer'));
    } // End Method


    public function InvoiceStore(Request $request)
    {

        if ($request->category_id == null) {

            $notification = array(
                'message' => 'Sorry You do not select any item',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {
            if ($request->paid_amount > $request->estimated_amount) {

                $notification = array(
                    'message' => 'Sorry Paid Amount is Maximum the total price',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            } else {

                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->created_by = Auth::user()->id;

                DB::transaction(function () use ($request, $invoice) {
                    if ($invoice->save()) {
                        $count_category = count($request->category_id);
                        for ($i = 0; $i < $count_category; $i++) {

                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('Y-m-d', strtotime($request->date));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status = '1';
                            $invoice_details->save();
                        }

                        if ($request->customer_id == '0') {
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->mobile_no = $request->mobile_no;
                            $customer->address = $request->address;
                            $customer->save();
                            $customer_id = $customer->id;
                        } else {
                            $customer_id = $request->customer_id;
                        }

                        $payment = new Payment();
                        $payment_details = new PaymentDetail();

                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;

                        if ($request->paid_status == 'full_paid') {
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                        } elseif ($request->paid_status == 'full_due') {
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0';
                        } elseif ($request->paid_status == 'partial_paid') {
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $payment_details->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();

                        $payment_details->invoice_id = $invoice->id;
                        $payment_details->date = date('Y-m-d', strtotime($request->date));
                        $payment_details->save();
                    }
                });
            } // end else
        }

        $notification = array(
            'message' => 'Invoice Data Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('invoice.pending')->with($notification);
    } // End Method


    public function InvoicePending()
    {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        return view('admin.invoice_pending', compact('allData'));
    }

    public function InvoiceDelete($id){

        $invoice = Invoice::findOrFail($id)->delete();
        $invoice->delete();
        invoiceDetail::where('invoice_id',$invoice->id)->delete();
        PAyment::where('invoice_id',$invoice->id)->delete();
        paymentDetail::where('invoice_id',$invoice->id)->delete();

         $notification = array(
        'message' => 'Invoice Deleted Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);

    } // End Method



    public function InvoiceApprove($id){

        $invoice = Invoice::with('invoice_details')->findOrFail($id);

        return view('admin.invoice_approve', compact('invoice'));

    }


    public function ApproveStore(Request $request, $id){

        foreach($request->selling_qty as $key => $val){
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id',$invoice_details->product_id)->first();
            if($product->quantity < $request->selling_qty[$key]){
                # code...
                $notification = array(
                    'message' => 'Sorry You Have Approved Maximum Value',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }

        $invoice = Invoice::findOrFail($id);
        $invoice->updated_by = Auth::user()->id;
        $invoice->status = '1';

        DB::transaction((function()use ($request, $invoice,$id){
            foreach ($request->selling_qty as $key => $val) {
                # code...
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $invoice_details-> status = '1';
                $invoice_details->save();
            $product = Product::where('id',$invoice_details->product_id)->first();
            $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
            $product->save();
            }// end of my foreach

            $invoice->save();
        }));

        $notification = array(
            'message' => 'Invoice Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('invoice.pending')->with($notification);
    }

    public function InvoicePrint($id){
        $invoice = Invoice::with('invoice_Details')->findOrFail($id);
        return view('Pdf.invoice_pdf', compact('invoice'));
    }

    public function DailyReport(){
        return view('Pdf.Daily_invoice_report');
    }

    public function DailyInvoiceReportPdf(Request $request){

        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $allData = Invoice::whereBetween('date',[$sdate,$edate])->where('status', '1')->get();

        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));

        return view('Pdf.daily_invoice_pdf',compact('allData', 'start_date', 'end_date'));

    }


}
