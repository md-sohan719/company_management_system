<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function AboutPage()
    {
        $aboutPage = About::find(1);
        return view('backend.about_page.about_update', compact('aboutPage'));
    }

    public function UpdateAbout(Request $request)
    {
        $about_id = $request->id;
        if ($request->file('about_image')) {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/'), $name_gen);

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $name_gen,
            ]);
            $notification = array(
                'message' => 'About Updated with Image Successfully',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);
            $notification = array(
                'message' => 'About Updated without Image Successfully',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
    }

    public function HomeAbout()
    {
        $aboutPage = About::find(1);
        return view('frontend.about_page', compact('aboutPage'));
    }

    public function AboutMultiIMage()
    {
        return view('backend.about_page.multi_image');
    }



    public function StoreMultiIMage(Request $request)
    {
        $images = $request->file('multi_image');
        foreach ($images as $image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/'), $name_gen);

            MultiImage::insert([
                'image_path' => $name_gen,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Image created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.multi.image')->with($notification);
    }

    public function AllMultiIMage()
    {
        $allMultiImage = MultiImage::all();
        return view('backend.about_page.all_multi_image', compact('allMultiImage'));
    }

    public function UpdateMultiIMage(Request $request)
    {
        $request->validate([
            'multi_image' => 'required|image',
        ]);

        $image_id = $request->id;
        $image = $request->file('multi_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload/'), $name_gen);

        MultiImage::findOrFail($image_id)->update([
            'image_path' => $name_gen,
        ]);
        $notification = array(
            'message' => 'Image Updated Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function DeleteMultiIMage($id)
    {
        $multiImg = MultiImage::findOrFail($id);
        $img = $multiImg->image_path;
        unlink('upload/' . $img);
        MultiImage::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Image Deleted Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
