<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UnitAll(){

        $units = Unit::latest()->get();
        return view('unit.unit_all',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UnitAdd(){
        return view('unit.unit_add');
    } // End Method



     public function UnitStore(Request $request){

        Unit::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Unit Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function UnitEdit($id){

            $unit = Unit::findOrFail($id);
        return view('unit.unit_edit',compact('unit'));

    }// End Method


    public function UnitUpdate(Request $request){

        $unit_id = $request->id;

        Unit::findOrFail($unit_id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Unit Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);

    }// End Method


    public function UnitDestroy($id){

            Unit::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Unit Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }



}
