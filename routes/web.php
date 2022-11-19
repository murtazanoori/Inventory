<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;

Route::get('/', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::controller(AdminController::class)->group(function (){
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::get('/edit/profile', 'Editprofile')->name('admin.edit_profile');
    Route::post('/store/profile', 'Storeprofile')->name('store.profile');
    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');

});

// Supplier Routes

Route::controller(SupplierController::class)->group(function () {
    Route::get('/supplier/all', 'SupplierAll')->name('supplier.all');
    Route::get('/supplier/add', 'SupplierAdd')->name('supplier.add');
    Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
    Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit');
    Route::post('/supplier/update/', 'SupplierUpdate')->name('supplier.update');
    Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');

});


//Customer Routes
Route::controller(CustomerController::class)->group(function (){
    Route::get('/customer/all', 'CustomerAll')->name('customer.all');
    Route::get('/customer/add', 'CustomerAdd')->name('customer.add');
    Route::post('/customer/store', 'CustomerStore')->name('customer.store');
    Route::get('/customer/edit/{id}', 'CustomerEdit')->name('Customer.edit');
    Route::post('/customer/update/', 'CustomerUpdate')->name('customer.update');
    Route::get('/customer/delete/{id}', 'CustomerDelete')->name('customer.delete');
    Route::get('/customer/dailyreport', 'CustomerReport')->name('customer.dailyreport');
    Route::get('/customer/dailycustomerpdf', 'CustomerReportPdf')->name('customer.DailycustomerReportPdf');
    Route::get('/customer/customereditinvoice{id}', 'CustomerReportEdit')->name('customer.reportedit');
    Route::post('/customer/updateinvoice/{id}', 'CustomerUpdateInvoice')->name('customer.updateinvoice');
    Route::get('/customer/invoicedetails/{invoice_id}', 'CustomerInvoiceDetails')->name('customer.invoicedetails');
    Route::get('/customer/paidreport}', 'PaidCustomer')->name('customer.paidreport');
    Route::get('/customer/paidpdf', 'PaidCustomerPdf')->name('customer.paidpdf');
    Route::get('/customer/customerwise', 'CustomerWise')->name('customer.wisereport');
    Route::get('/customer/customerwisePdf', 'CustomerWisePdf')->name('customer.wisereportpdf');
    Route::get('/customer/customerpaidpdf', 'CustomerPaid')->name('customer.customerpaidpdf');
});

//Unit Routes

Route::controller(UnitController::class)->group(function (){
    Route::get('/unit/all', 'UnitAll')->name('unit.all');
    Route::get('/unit/add', 'UnitAdd')->name('unit.add');
    Route::post('/unit/store', 'UnitStore')->name('unit.store');
    Route::get('/unit/edit/{id}', 'UnitEdit')->name('unit.edit');
    Route::post('/unit/update/', 'UnitUpdate')->name('unit.update');
    Route::get('/unit/delete/{id}', 'UnitDelete')->name('unit.delete');

});


//Category Routes

Route::controller(CategoryController::class)->group(function (){
    Route::get('/category/all', 'CategoryAll')->name('category.all');
    Route::get('/category/add', 'CategoryAdd')->name('category.add');
    Route::post('/category/store', 'CategoryStore')->name('category.store');
    Route::get('/category/edit/{id}', 'CategoryEdit')->name('category.edit');
    Route::post('/category/update/', 'CategoryUpdate')->name('category.update');
    Route::get('/category/delete/{id}', 'CategoryDelete')->name('category.delete');

});


//Products Routes

Route::controller(ProductController::class)->group(function (){
    Route::get('/product/all', 'ProductAll')->name('product.all');
    Route::get('/product/add', 'ProductAdd')->name('product.add');
    Route::post('/product/store', 'ProductStore')->name('product.store');
    Route::get('/product/edit/{id}', 'ProductEdit')->name('product.edit');
    Route::post('/product/update/', 'ProductUpdate')->name('product.update');
    Route::get('/product/delete/{id}', 'ProductDelete')->name('product.delete');

});


//Purchase Routes

Route::controller(PurchaseController::class)->group(function (){
    Route::get('/purchase/all', 'PurchaseAll')->name('purchase.all');
    Route::get('/purchase/add', 'PurchaseAdd')->name('purchase.add');
    Route::post('/purchase/store', 'PurchaseStore')->name('purchase.store');
    Route::get('/purchase/delete/{id}', 'PurchaseDelete')->name('purchase.delete');
    Route::get('/purchase/pending/', 'PurchasePending')->name('purchase.pending');
    Route::get('/purchase/approve/{id}', 'PurchaseApprove')->name('purchase.approve');
    Route::get('/purchase/dailyreport', 'PurchaseReport')->name('purchase.dailyreport');
    Route::get('/purchase/dailypurchasepdf', 'PurchaseReportPdf')->name('invoice.DailypurchaseReportPdf');


});



//Default Route

Route::controller(DefaultController::class)->group(function(){
    Route::get('/get-category', 'GetCategory')->name('get-category');
    Route::get('/get-product', 'GetProduct')->name('get-product');
    Route::get('/check-product', 'GetStock')->name('check-product-stock');
});


//Invoice Routes
Route::controller(InvoiceController::class)->group(function(){
    Route::get('/invoice/all', 'InvoiceAll')->name('invoice.all');
    Route::get('/invoice/add', 'InvoiceAdd')->name('invoice.add');
    Route::post('/invoice/store', 'InvoiceStore')->name('invoice.store');
    Route::get('/invoice/pending', 'InvoicePending')->name('invoice.pending');
    Route::get('/invoice/delete/{id}', 'InvoiceDelete')->name('invoice.delete');
    Route::get('/invoice/approve/{id}', 'InvoiceApprove')->name('invoice.approve');
    Route::post('/approve/store/{id}', 'ApproveStore')->name('approve.store');
    Route::get('/invoice/print/{id}', 'InvoicePrint')->name('invoice.print');
    Route::get('/invoice/dailyreport', 'DailyReport')->name('invoice.dailyreport');
    Route::get('/invoice/dailyinvoicepdf', 'DailyInvoiceReportPdf')->name('invoice.DailyInvoiceReportPdf');


});




//Stock Routes

Route::controller(StockController::class)->group(function(){
    Route::get('/stock/stockreport', 'StockReport')->name('stock.report');
    Route::get('/stock/stockreportpdf', 'StockReportPdf')->name('stock.reportPdf');
    Route::get('/stock/supplierreport', 'StockSupplier')->name('stock.supplierreport');
    Route::get('/stock/supplierreportpdf', 'StockSupplierPdf')->name('stock.supplierreportPdf');
    Route::get('/stock/productreportpdf', 'StockProductPdf')->name('stock.productreportPdf');
});


route::view('testing','admin.testing');

require __DIR__.'/auth.php';
