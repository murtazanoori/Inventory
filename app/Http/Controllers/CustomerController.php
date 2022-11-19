<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\paymentDetail;
use App\Models\Payment;

class CustomerController extends Controller
{
    //

    public function CustomerAll(){

        $customers = customer::latest()->get();
        return view('admin.customer_all',compact('customers'));
    }

    public function CustomerAdd(){
        return view('admin.customer_add');
    }

    public function CustomerStore(Request $request){
        customer::insert([
            'name'=> $request->name,
            'fname'=> $request->fname,
            'job'=> $request->job,
            'department'=> $request->department,
            'mobile_no'=> $request->mobile_no,
            'address'=> $request->address,
            'created_by'=> Auth::user()->id,
            'created_at'=> Carbon::now(),
        ]);
        $notification = array('message' =>'Customer Inserted Successfully',
        'alert-type' => 'success');

        return redirect()->route('customer.all')->with($notification);
    }

    public function CustomerEdit($id){
        $customers = Customer::findorFail($id);
        return view('admin.customer_edit', compact('customers'));
    }

    public function CustomerUpdate(Request $request){

        $customer_id = $request->id;

        customer::findOrFail($customer_id)->update([
            'name' => $request->name,
            'fname' => $request->fname,
            'job' => $request->job,
            'department' => $request->department,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Customer Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);

    }

    public function CustomerDelete($id){

        customer::findOrFail($id)->delete();

         $notification = array(
              'message' => 'Customer Deleted Successfully',
              'alert-type' => 'success'
          );

          return redirect()->back()->with($notification);
      }

      public function CustomerReport(){
        $allData = Payment::whereIn('paid_status',['full_due ','partial_paid'])->get();
        return view('admin.customer_report',compact('allData'));
      }


      public function CustomerReportPdf(Request $request){
        $allData = Payment::whereIn('paid_status',['full_due ','partial_paid'])->get();
        return view('admin.customer_report_pdf',compact('allData'));

      }

      public function CustomerReportEdit($invoice_id){
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('admin.Customer_edit_invoice',compact('payment'));
      }

      public function CustomerUpdateInvoice(Request $request,$invoice_id){
        if ($request->new_paid_amount < $request->paid_amount) {
            $notification = array(
                'message' => 'Sorry You Have selected Maximum Value',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;

            if ($request->paid_status == 'full_paid') {
                 $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                 $payment->due_amount = '0';
                 $payment_details->current_paid_amount = $request->new_paid_amount;

            } elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;

            }

            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            $payment_details->updated_by = Auth::user()->id;
            $payment_details->save();

              $notification = array(
            'message' => 'Invoice Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('customer.dailyreport')->with($notification);
      }
    }


    public function CustomerInvoiceDetails($invoice_id){

        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('admin.customer_invoice_details',compact('payment'));
    }

    public function PaidCustomer(){
        $allData = Payment::where('paid_status', '!=', 'full_due')->get();
        return view ('admin.paid_customer_report',compact('allData'));
    }

    public function PaidCustomerPdf(){
        $allData = Payment::where('paid_status', '!=', 'full_due')->get();
        return view('admin.paid_customer_print',compact('allData'));
    }

    public function CustomerWise(){
        $customers = Customer::all();
        return view('admin.customer_wise_report',compact('customers'));
    }

    public function CustomerWisePdf(Request $request){
        $allData = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('admin.customer_wise_pdf',compact('allData'));
    }


    public function CustomerPaid(Request $request){
        $allData = Payment::where('customer_id',$request->customer_id)->where('paid_status','!=','full_due')->get();
        return view ('admin.paid_customer_report',compact('allData'));
    }
}


