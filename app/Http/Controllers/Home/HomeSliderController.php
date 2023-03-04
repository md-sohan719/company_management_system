<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    public function HomeSlider()
    {
        $homeSlide = HomeSlide::find(1);
        return view('backend.home_slide.home_slider', compact('homeSlide'));
    }

    public function UpdateSlide(Request $request)
    {
        $slide_id = $request->id;
        if ($request->file('home_slide')) {
            $image = $request->file('home_slide');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/'), $name_gen);

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $name_gen,
            ]);
            $notification = array(
                'message' => 'Home Slide Updated with Image Successfully',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url
            ]);
            $notification = array(
                'message' => 'Home Slide Updated without Image Successfully',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
    }
}
