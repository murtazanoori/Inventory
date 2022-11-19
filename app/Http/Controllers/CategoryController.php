<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CategoryController extends Controller
{
    //


    public function CategoryAll(){

        $category = category::latest()->get();
        return view('admin.category_all',compact('category'));
    }

    public function CategoryAdd(){
        return view('admin.category_add');
    }

    public function CategoryStore(Request $request){
        Category::insert([
            'category'=> $request->category,
            'created_by'=> Auth::user()->id,
            'created_at'=> Carbon::now(),
        ]);
        $notification = array('message' =>'Category Inserted Successfully',
        'alert-type' => 'success');

        return redirect()->route('category.all')->with($notification);
    }

    public function CategoryEdit($id){
        $category = Category::findorFail($id);
        return view('admin.category_edit', compact('category'));
    }

    public function CategoryUpdate(Request $request){

        $category_id = $request->id;

        Category::findOrFail($category_id)->update([
            'category' => $request->category,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($notification);

    }

    public function CategoryDelete($id){

        Category::findOrFail($id)->delete();

         $notification = array(
              'message' => 'Category Deleted Successfully',
              'alert-type' => 'success'
          );

          return redirect()->back()->with($notification);

      }
}
