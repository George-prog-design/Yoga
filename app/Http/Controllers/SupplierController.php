<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SupplierAll()
    {
        $suppliers = Supplier::latest()->get();
        return view('supplier.supplier_all',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SupplierCreate(Request $request)
    {
       Supplier::insert([
        'name' => $request->name,
        'email' => $request->email,
        'mobile_no' => $request->mobile_no,
        'address' => $request->address,
        'created_by' => Auth::user()->id,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at'=> now(),
       ]);


       $notification = array(
            'message' => 'Supplier Created.',
            'alert-type' => 'success',
        );

        return redirect()->route('supplier.all')->with($notification);

    }

    public function SupplierAdd()
    {
        return view('supplier.supplier_add');
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SupplierEdit($id)
    {
       $supplier = Supplier::findOrFail($id);
        return view('supplier.supplier_edit',compact('supplier'));
    }


    public function SupplierUpdate(Request $request, $id)
    {
       $edit_supplier = Supplier::where('id',$request->id);

       $edit_supplier->update([
        'name' => $request->name,
        'email' => $request->email,
        'mobile_no' => $request->mobile_no,
        'address' => $request->address,
        'updated_by'=> Auth::user()->id,
    ]);
        $notification = array(
            'message' => 'Supplier Updated.',
            'alert-type' =>'success',
        );
        return redirect()->route('supplier.all')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SupplierDestroy($id)
    {
        $supplier_delete = Supplier::where('id', $id)->delete();
        $notification = array(
            'message' => 'Supplier Deleted.',
            'alert-type' => 'error',
        );
        return redirect()->route('supplier.all')->with($notification);
    }
}
