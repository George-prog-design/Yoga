<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function CategoryAll(){

        $categoris = Category::latest()->get();
        return view('category.category_all',compact('categoris'));

    }
    public function CategoryAdd(){
        return view('category.category_add');
       } // End Mehtod


       public function CategoryStore(Request $request){

           Category::insert([
               'name' => $request->name,
               'created_by' => Auth::user()->id,
               'created_at' => Carbon::now(),

           ]);

            $notification = array(
               'message' => 'Category Inserted Successfully',
               'alert-type' => 'success'
           );

           return redirect()->route('category.all')->with($notification);

       }

       public function CategoryEdit($id){

        $category = Category::findOrFail($id);
      return view('category.category_edit',compact('category'));

  }// End Method


   public function CategoryUpdate(Request $request){

      $category_id = $request->id;

      Category::findOrFail($category_id)->update([
          'name' => $request->name,
          'updated_by' => Auth::user()->id,
          'updated_at' => Carbon::now(),

      ]);

       $notification = array(
          'message' => 'Category Updated Successfully',
          'alert-type' => 'success'
      );

      return redirect()->route('category.all')->with($notification);

  }// End Method


  public function CategoryDelete($id){

        Category::findOrFail($id)->delete();

     $notification = array(
          'message' => 'Category Deleted Successfully',
          'alert-type' => 'success'
      );

      return redirect()->back()->with($notification);

  }
}
