<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PortfolioController extends Controller
{
    public function AllPortfolio()
    {
        $portfolio = Portfolio::latest()->get();
        return view('backend.portfolio.portfolio_all', compact('portfolio'));
    }

    public function AddPortfolio()
    {
        return view('backend.portfolio.portfolio_add');
    }

    public function StorePortfolio(Request $request)
    {
        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ], [
            'portfolio_name.required' => 'Portfolio Name is Required',
            'portfolio_title.required' => 'Portfolio Title is Required',
            'portfolio_image.required' => 'Portfolio Image is Required',
        ]);

        $image = $request->file('portfolio_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload/'), $name_gen);

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_image' => $name_gen,
            'portfolio_description' => $request->portfolio_description,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Portfolio Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.portfolio')->with($notification);
    }

    public function EditPortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('backend.portfolio.portfolio_edit', compact('portfolio'));
    }

    public function UpdatePortfolio(Request $request)
    {
        $portfolio_id = $request->id;
        if ($request->file('portfolio_image')) {
            $image = $request->file('portfolio_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/'), $name_gen);

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $name_gen,
            ]);
            $notification = array(
                'message' => 'Portfolio Updated with Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.portfolio')->with($notification);
        } else {
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description
            ]);
            $notification = array(
                'message' => 'Portfolio Updated without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.portfolio')->with($notification);
        }
    }

    public function DeletePortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $img = $portfolio->portfolio_image;
        unlink('upload/' . $img);
        Portfolio::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Portfolio Deleted Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function PortfolioDetails($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('frontend.portfolio_details', compact('portfolio'));
    }
}
