<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\HomeSlide;
use App\Models\Multi_image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function AboutSlider()
    {
        $About = About::find(1);

        return view('admin.about_page.home_page_all', compact('About'));
    }

    public function UpdateAbout(Request $request)
    {
        $aboutId = $request->id;

        if ($request->hasFile('about_image')) {
            $file = $request->file('about_image'); // Change 'home_slide' to 'about_image'
            $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'upload/home_about'; // Destination folder
            $file->move(public_path($destinationPath), $name);

            $filePath = $destinationPath . '/' . $name; // Construct the file path

            About::findOrFail($aboutId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $filePath, // Update with the correct file path
            ]);

            session()->flash('message', 'About page with image updated successfully');
        } else {
            About::findOrFail($aboutId)->update([ // Change $slideId to $aboutId
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);

            session()->flash('message', 'Slider without image updated successfully');
        }

        return redirect()->back();
    }

    public function HomeAbout(){
        $about = About::find(1);
        return view('frontend.about_page', compact('about'));
    }



    public function AboutMultiImage(){
        return view('admin.about_page.multimage');
    }

    public function StoreMultiImage(Request $request){
        $image = $request->file('multi_image');
        foreach($image as $multi_image){
            $name = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
            $destinationPath = 'upload/multi_images'; // Destination folder
            $multi_image->move(public_path($destinationPath), $name);

            $filePath = $destinationPath . '/' . $name; // Construct the file path

            Multi_image::insert([

                'multi_images' => $filePath,
                'created_at' => Carbon::now()// Update with the correct file path
            ]);

            session()->flash('message', 'Multi images inserted successfully');




        }

        return redirect()->back();




        }


        public function AllMultiImage() {
            $allmultiimage = Multi_image::AllMultiImage();
            return view ('admin.about_page', compact('allmultiimage'));
        }

}
