<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CustomerAll()
    {
        $customers = Customer::latest()->get();
        return view('customer.customer_all', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CustomerAdd(Request $request)
    {
        return view('customer.customer_add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function CustomerStore(Request $request)
    {
        $image = $request->file('customer_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload/customer'), $name_gen);
        $save_url = 'upload/customer/' . $name_gen;


        Customer::insert([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
            'customer_image' => $save_url,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at'=> now(),
           ]);


           $notification = array(
                'message' => 'Customer Created.',
                'alert-type' => 'success',
            );

            return redirect()->route('customer.all')->with($notification);
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
    public function CustomerEdit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.customer_edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CustomerUpdate(Request $request, $id)
    {
        $customer_id = $request->id;
        if ($request->file('customer_image')) {

            $image = $request->file('customer_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // Generate a unique file name
            $image->move(public_path('upload/customer'), $name_gen); // Move the uploaded file to the desired directory
            $save_url = 'upload/customer/' . $name_gen; // Save the file path for later use


        Customer::findOrFail($customer_id)->update([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'customer_image' => $save_url ,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Customer Updated with Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);

        } else{

          Customer::findOrFail($customer_id)->update([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Customer Updated without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.all')->with($notification);

        } // end else
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CustomerDestroy($id)
    {
        $customer = Customer::find($id);
        $img = $customer->customer_image;
        unlink($img);
        
        $customer->delete();
        $notification = array(
            'message' => 'Customer Deleted.',
            'alert-type' => 'success',
        );
        return redirect()->route('customer.all')->with($notification);
    }
}
