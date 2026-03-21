<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Storage;

class ProductController extends Controller
{

    public function index(){  //creating our models here.
        $products=Product::orderBy('created_at', 'desc')->get();
        return view('admin.product.index')->with('products', $products);

    }

    public function create(){  //creating our models here.

        return view('admin.product.create');
    }

    public function edit($id){  //creating our models here.

        $product =Product::findorfail($id);

        return view('admin.product.edit', compact('product'));


    }

    public function store(Request $request){

         $request->validate([
            'name'=>'required',
            'slug' => 'required|unique:products|max:255',
            'description' => 'required',
            'client' => 'required',
            'url' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('product_image')){
            $file =$request->file('product_image');
            $imageName=time().'_'.$file->getClientOriginalName();
            $file->move(\public_path('product_image/'),$imageName);


            $product=new Product;
            $product->name=$request->name;
                $product->slug=$request->slug;
                $product->description=$request->description;
                $product->client=$request->client;
                $product->url=$request->url;
                $product->product_image=$imageName;

            $product->save();

        }
        if($request->hasFile('body_images')){
            $files =$request->file('body_images');
            foreach($files as $file){
                $imageName=time().'_'.$file->getClientOriginalName();
                $request['product_id']=$product->id;
                $request['body_image']=$imageName;

                // dd($request['body_image']);
                $file->move(\public_path('product_images/'),$imageName);
                ProductImage::create($request->all());


            }
        }

        return redirect('/index_product');
    }

    public function update(Request $request,$id) {
        $product=Product::findorfail($id);
        if($request->hasFile('product_image')){
//

            if (File::exists("/product_image/".$product->product_image))
            {
                File::delete("/product_image/".$product->product_image);
            }

            $file=$request->file('product_image');
            $product->product_image=time()."".$file->getClientOriginalName();
            $file->move(\public_path('product_image/'),$product->product_image);
            $request['product_image']=$product->product_image;

        } else{
            $product->update([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'description'=>$request->description,
                'product_image'=> $product->product_image,
            ]);
        }

        return redirect('/index_product');

    }

    public function destroy($id)
    {

        $product = Product::findorfail($id);


        $product->delete();

        return redirect()->route('index.product')->with('status1', 'The ' . $product->name . ' Product has been deleted');


    }

    public function show($slug){


        $product=Product::where('slug', $slug)->firstOrFail();
        $more_images=$product->product_images;
       // $images=$itenary->itenary_images;


     //  dd($more_images);
        return view('client.product.product_details')->with('product', $product)->with('more_images', $more_images);
    }


    public function product_index(){
        $products=Product::orderBy('created_at', 'desc')->get();
        return view('client.product.product')->with('products', $products);
    }




    public function deleteCoverImage($id){
        $product_image = Product::findOrFail($id)->product_image;

        //dd($cover_image);

        if(File::exists('product_image/'.$product_image)){
            File::delete('product_image/'.$product_image);
        }
        return back();
    }


}
