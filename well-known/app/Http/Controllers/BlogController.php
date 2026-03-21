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
        return view('admin.blog.create_post')->with('blogcats', $blogcats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        $this->validate($request, ['category'=> 'required',

            'name'=> 'required',
            'author'=> 'required',
            'slug'=> 'required',
            'description'=> 'required',
            'image'=>'image|nullable|max:1999']);


        if($request->input('category')){
            if($request->hasFile('image')){
            //1 : get filename with ext
                $fileNameWithExt = $request->file('image')->getClientOriginalName();

            //2 : get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //3 : get just extension
                $extension = $request->file('image')->getClientOriginalExtension();

            //4 : file name to store


                $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //upload image

                $path =$request->file('image')->storeAs('public/posts_images', $fileNameToStore);

            }

            else{

                $fileNameToStore ='noimage.jpg';

            }

            $post=new Blog();
            $post->name =$request->input('name');
            $post->author =$request->input('author');
            $post->category =$request->input('category');
            $post->slug =$request->input('slug');
            $post->description =$request->input('description');
            $post->image =$fileNameToStore;
            $post->save();

        //return dd($request->all());

            return redirect()->route('blog.index2')->with('status', 'The '.$post->name.' Post has been saved successfully');

        }

        else {
            return redirect()->route('blog.create')->with('status1', 'You need to select a Category for your Post');
        }

    }

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
