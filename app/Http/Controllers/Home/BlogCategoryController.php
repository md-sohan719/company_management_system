<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogCategoryController extends Controller
{
    public function AllBlogCategory()
    {
        $blogCategory = BlogCategory::latest()->get();
        return view('backend.blog_category.blog_category_all', compact('blogCategory'));
    }

    public function StoreBlogCategory(Request $request)
    {
        BlogCategory::insert([
            'blog_category' => $request->blog_category,
            'created_at' => Carbon::now('Asia/Dhaka'),
        ]);
        $notification = array(
            'message' => 'Blog Category created successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function UpdateBlogCategory(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'blog_category' => 'required'
        ]);
        BlogCategory::findOrFail($id)->update([
            'blog_category' => $request->blog_category,
        ]);
        $notification = array(
            'message' => 'Blog Category updated successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function DeleteBlogCategory($id)
    {
        BlogCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Category deleted successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
