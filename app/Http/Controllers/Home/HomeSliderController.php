<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    public function HomeSlider(){
        $home = HomeSlide::find(1);

        return view('admin.home_slide.home_slide_all', compact('home'));
    }

    public function UpdateSlider(Request $request){
        $slideId = $request->id;

        if($request->hasFile('home_slide')) {
            $file = $request->file('home_slide');
            $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'upload/home_slide'; // Destination folder
            $file->move(public_path($destinationPath), $name);

            $filePath = $destinationPath . '/' . $name; // Construct the file path

            HomeSlide::findOrFail($slideId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $filePath, // Update with the correct file path
            ]);

            session()->flash('message', 'Slider with image updated successfully');
        } else {
            HomeSlide::findOrFail($slideId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);

            session()->flash('message', 'Slider without image updated successfully');
        }

        return redirect()->back();
    }

   

}





