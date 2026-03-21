<?php

namespace App\Http\Controllers\BackOffice;
use App\Http\Controllers\Controller;
use App\Models\BackOffice\BlogCategory;
use App\Models\BackOffice\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Storage;
use App\Mail\BlogMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function EditBlog($id){
        $blog = Blog::findOrFail($id);
        $blog_cats = BlogCategory::orderBy('created_at', 'desc')->get();

        return view('admin.backOffice.blog.edit_blog', compact('blog', 'blog_cats'));
    }

    public function AddBlog(){
        $blogcats = BlogCategory::all();
        return view('admin.backOffice.blog.add_blog', compact('blogcats'));
    }

    public function StoreBlog(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'author' => 'required',
        ]);

        $slug = Str::slug($request->name);
        $save_url = null;

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = $slug . '.' . $image->getClientOriginalExtension();
            
            // Create directory if not exists
            if (!file_exists('upload/blog_image')) {
                mkdir('upload/blog_image', 0777, true);
            }
            
            // Save image directly without GD library
            $image->move('upload/blog_image', $name_gen);
            $save_url = 'upload/blog_image/' . $name_gen;
        }

        $blog = Blog::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'author' => $request->author,
            'blog_category_id' => $request->category,
            'image' => $save_url,
        ]);

        $notification = [
            'message' => 'Blog ' . ($save_url ? 'with Image ' : 'without Image ') . 'has been Created Successfully',
            'alert-type' => $save_url ? 'info' : 'warning',
        ];

        Contact::chunk(100, function ($contacts) use ($data, $save_url) {
            foreach ($contacts as $contact) {
                Mail::to($contact->email)
                    ->queue(new BlogMail($data, $save_url, $contact->name));
            }
        });

        return redirect()->route('index.blog')->with($notification);
    }

    public function DeleteBlog($id){
        Blog::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }

    public function AddBlogCategory(){
        return view('admin.backOffice.blog.add_blog_category');
    }

    public function UpdateBlog(Request $request){
        $blog_id = $request->id;

        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $slug = Str::slug($request->name);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            
            // Create directory if not exists
            if (!file_exists('upload/blog_image')) {
                mkdir('upload/blog_image', 0777, true);
            }
            
            // Save image directly without GD library
            $image->move('upload/blog_image', $name_gen);
            $save_url = 'upload/blog_image/' . $name_gen;
            
            Blog::findOrFail($blog_id)->update([
                'name' => $request->name,
                'slug' => $slug,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'image' => $save_url,
                'author' => $request->author,
                'blog_category_id' => $request->category,
            ]);

            $notification = array(
                'message' => 'Blog Post With Image has been Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('index.blog')->with($notification);
        } else {
            Blog::findOrFail($blog_id)->update([
                'name' => $request->name,
                'slug' => $slug,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'author' => $request->author,
                'blog_category_id' => $request->category,
            ]);

            $notification = array(
                'message' => 'Blog Post without an Image has been Updated Successfully',
                'alert-type' => 'warning'
            );

            return redirect()->route('index.blog')->with($notification);
        }
    }

    public function StoreBlogCategory(Request $request){
        $validateData = $request->validate([
            'title' => 'required',
        ]);

        $blog_cat = new BlogCategory();
        $blog_cat->name = $request->title;
        $blog_cat->description = $request->short_title;
        $blog_cat->save();

        $notification = [
            'message' => 'Blog category has been Created Successfully',
            'alert-type' => 'warning'
        ];

        return redirect()->route('index.blog.category')->with($notification);
    }

    public function IndexOfBlogs(){
        $blogs = Blog::with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.backOffice.blog.index_blog', compact('blogs'));
    }

    public function IndexOfBlogCategories(){
        $blog_cats = BlogCategory::orderBy('created_at', 'desc')->get();
        return view('admin.backOffice.blog.index_blog_category')->with('blog_cats', $blog_cats);
    }

    public function DeleteBlogCategory($id){
        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }

    public function IndexOfClientBlogs(){
        $blog_posts = Blog::get();
        $data = Blog::paginate(5);
        return view("client.blog.blog_list")->with('blog_posts', $blog_posts)->with('data', $data);
    }

    public function ShowBlog($slug){
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $blog_posts = Blog::get();
        $blogcats = BlogCategory::get();
        
        $previous = Blog::where('slug', '<', $blog->slug)->max('slug');
        $next = Blog::where('slug', '>', $blog->slug)->min('slug');

        return view('client.blog.blog_details')->with('blog', $blog)->with('blog_posts', $blog_posts)->with('blogcats', $blogcats)->with('previous', $previous)->with('next', $next);
    }
}
