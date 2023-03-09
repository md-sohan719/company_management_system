<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function AllBlog()
    {
        $allBlog = Blog::latest()->get();
        return view('backend.blog.blog', compact('allBlog'));
    }

    public function AddBlog()
    {
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('backend.blog.blog_add', compact('categories'));
    }

    public function StoreBlog(Request $request)
    {
        $request->validate([
            'blog_category_id' => 'required',
            'blog_title' => 'required',
        ]);

        $image = $request->file('blog_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload/'), $name_gen);

        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_image' => $name_gen,
            'blog_description' => $request->blog_description,
            'blog_tags' => $request->blog_tags,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.blog')->with($notification);
    }

    public function EditBlog($id)
    {
        $blogInfo = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('backend.blog.blog_edit', compact('blogInfo', 'categories'));
    }

    public function UpdateBlog(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'blog_category_id' => 'required',
            'blog_title' => 'required',
        ]);

        if ($request->file('blog_image')) {
            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/'), $name_gen);

            Blog::find($id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_image' => $name_gen,
                'blog_description' => $request->blog_description,
                'blog_tags' => $request->blog_tags,
            ]);
            $notification = array(
                'message' => 'Blog updated with Image Successfully',
                'alert-type' => 'success'
            );
        } else {
            Blog::find($id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_description' => $request->blog_description,
                'blog_tags' => $request->blog_tags,
            ]);
            $notification = array(
                'message' => 'Blog updated without Image Successfully',
                'alert-type' => 'success'
            );
        }

        return redirect()->route('all.blog')->with($notification);
    }

    public function DeleteBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $img = $blog->blog_image;
        unlink('upload/' . $img);
        Blog::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function BlogDetails($id)
    {
        $allBlogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $blogInfo = Blog::findOrFail($id);
        return view('frontend.blog_details', compact('blogInfo', 'allBlogs', 'categories'));
    }

    public function CategoryBlog($id)
    {
        $categoryBlog = Blog::where('blog_category_id', $id)->orderBy('id', 'DESC')->get();
        $allBlogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $categoryInfo = BlogCategory::findOrFail($id);
        return view('frontend.cat_blog_details', compact('categoryBlog', 'allBlogs', 'categories', 'categoryInfo'));
    }

    public function HomeBlog()
    {
        $allBlogs = Blog::latest()->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('frontend.blog', compact('allBlogs', 'categories'));
    }
}
