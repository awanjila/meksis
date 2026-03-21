<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blogCategory;
use App\Models\Blog;


class Blogcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $blog_posts=Blog::get();
        $data = Blog::paginate(5);
        return view("client.blog.blog_list")->with('blog_posts', $blog_posts)->with('data', $data);
    }

    public function index2()

    {
        $blog_posts=Blog::get();
        //$data = Blog::paginate(5);
        return view("admin.blog.blog_posts")->with('blog_posts', $blog_posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $blogcats = blogCategory::get();
        return view('admin.backOffice.blog.add_blog')->with('blogcats', $blogcats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



     public function Store(Request $request){

        $validateData = $request->validate([
           'name' => 'required',
           'description' => 'required',
       ]);
   
         $slug = Str::slug($request->name); // Generate slug from the blog name
        if ($request->file('image')) {
           $image = $request->file('image');
           $name_gen = $slug . '.' . $image->getClientOriginalExtension();
           Image::make($image)->resize(800, 400)->save('upload/blog_image/' . $name_gen);
           $save_url = 'upload/blog_image/' . $name_gen;
   
           $blog = new Blog();
           $blog->name = $request->name;
           $blog->description = $request->description;
           $blog->meta_title = $request->meta_title;
           $blog->meta_description = $request->meta_description;
           $blog->author = $request->author;
           $blog->blog_category_id = $request->category;
           $blog->image = $save_url;
           $blog->save();
   
           $notification = [
               'message' => 'Blog with Image has been Created Successfully',
               'alert-type' => 'info'
           ];
   
           return redirect()->route('index.blog')->with($notification);
   
       } else {
   
           $blog = new Blog();
           $blog->name = $request->name;
           $blog->description = $request->description;
           $blog->meta_title = $request->meta_title;
           $blog->meta_description = $request->meta_description;
           $blog->author = $request->author;
           $blog->blog_category_id = $request->category;
               // $blog->image = $save_url;
           $blog->save();
           $notification = [
               'message' => 'Blog without Image has been Created Successfully',
               'alert-type' => 'warning'
           ];
   
   
              // dd($notification);
   
           return redirect()->route('index.blog')->with($notification);
       }
   
   
       }//endmethod

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)

    {

     $blog=blog::where('slug', $slug)->firstOrFail();
     $blog_posts=blog::get();
     $blogcats = blogCategory::get();
    // $blogcategory=blogCategory::where('slug', $slug)->firstOrFail();

     // $post = Post::find($id);
    $previous = blog::where('slug', '<', $blog->slug)->max('slug');
     $next = blog::where('slug', '>', $blog->slug)->min('slug');
    // return view( 'post', compact( 'post', 'next', 'previous' ));



     return view('client.blog.blog_details')->with('blog', $blog)->with('blog_posts', $blog_posts)->with('blogcats', $blogcats)->with('previous', $previous)->with('next', $next);


 }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
