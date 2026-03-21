<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str; // Make sure to include this at the top of your file
use Illuminate\Support\Facades\File;
use App\Models\Product;


class CategoryController extends Controller
{
    public function AllCategory(){

        $categories=Category::latest()->get();

        return view('admin.backOffice.category.all_category', compact('categories'));
    } //endmethod


    public function AddCategory(Request $request){

        $categories=Category::latest()->get();

        return view('admin.backOffice.category.add_category', compact('categories'));
    } //endmethod


    public function StoreCategory(Request $request){

        $data = $request->validate([
            'category_name' => 'required|string|unique:categories,category_name',
            'meta_title' => 'required|string',
            'category_description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id', // Validate that the parent_id exists in the categories table
        ]);
    
        $slug = Str::slug($request->category_name);
        $category_image = $request->file('category_image');
        $name_gen = $slug . '.' . $category_image->getClientOriginalExtension();
        Image::make($category_image)->resize(300, 398)->save(public_path('upload/categories/' . $name_gen));
        $save_url = 'upload/categories/' . $name_gen;

        $category = new Category([
            'category_name' => $data['category_name'],
            'meta_title' => $data['meta_title'],
            'category_description' => $data['category_description'],
            'category_image' => $save_url,
            'slug' => Str::slug($request->category_name), // Generate slug from the category name

    ]);

        // if ($data['parent_id']) {
        //     $parentCategory = Category::find($data['parent_id']);
        //     $parentCategory->appendNode($category);
        // } else {
        //     $category->saveAsRoot();
        // }

        // return redirect()->route('all.category')->with('success', 'Category created successfully');
        // $validateData = $request->validate([
        //     'category_name'=>'required | max:200',

        // ]);


        Category::insert([
            'category_name'=> $request->category_name,
            'category_description' => $request->category_description,
            'slug' => Str::slug($request->category_name), // Generate slug from the category name
            'category_image' => $save_url,
            'created_at'=>Carbon::now(),
         ]);
       

        $notification = array(
            'message' => 'Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    } // endMethod


    public function EditCategory($id){
        $category=Category::findOrfail($id);
        $categories=Category::latest()->get();

        return view('admin.backoffice.category.edit_category', compact('category','categories'));

    } //EndMethod

    public function updateCategory(Request $request) {
        // Validate the input
        $category_id = $request->id;
        $data = $request->validate([
            'category_name' => 'required|string',
            'meta_title' => 'required|string',
            'category_description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id', // Validate that the parent_id exists in the categories table.
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validate image if provided
        ]);
    
        // Find the category to update
        $category = Category::findOrFail($category_id);
        
        // Generate slug from the category name
        $slug = Str::slug($request->category_name);
        
        // Check if a new image is uploaded
        if ($request->hasFile('category_image')) {
            $category_image = $request->file('category_image');
            $name_gen = $slug . '.' . $category_image->getClientOriginalExtension();
            Image::make($category_image)->resize(300, 398)->save(public_path('upload/categories/' . $name_gen));
            $save_url = 'upload/categories/' . $name_gen;
    
            // Remove the old image file
            if (File::exists(public_path($category->category_image))) {
                File::delete(public_path($category->category_image));
            }
    
            // Update image URL
            $category->category_image = $save_url;
        }
    
        // Update other fields
        $category->category_name = $data['category_name'];
        $category->meta_title = $data['meta_title'];
        $category->category_description = $data['category_description'];
        $category->slug = $slug;
    
        // Update parent category if necessary
        if ($data['parent_id']) {
            $parentCategory = Category::find($data['parent_id']);
            if ($parentCategory) {
                $category->parent_id = $data['parent_id'];
            } else {
                return back()->withInput()->with('error', 'Parent category does not exist.');
            }
        } else {
            $category->parent_id = null; // No parent
        }
    
        $category->save(); // Save the updated category
    
        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.category')->with($notification);
    }
    

    public function DeleteCategory($id){

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);


    }  //EndMethod

    public function __invoke(Request $request){
        return Category::all();

    }//endmethod

    
    public function Categories(){

        $categories=Category::all();
               return view('client.shop.shop_categories', compact('categories'));
       }//endmethod


       public function showCategory($slug){

        $category=Category::where('slug', $slug)->firstOrFail();
        $categories=Category::get();
        $items = Product::where('category_id', $category->id)->get();

//        dd($images);
        return view('client.shop.category_product_list', compact('category', 'categories', 'items'));
    }//endmethod

    public function index()
    {
        // Fetch all categories
        $categories = Category::all();
        
        // Return as JSON response
        return response()->json($categories);
    }//endmethod

}
