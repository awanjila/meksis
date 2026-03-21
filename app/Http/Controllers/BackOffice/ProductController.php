<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str; // Make sure to include this at the top of your file


class ProductController extends Controller
{
    public function AllProduct(){
        $products= Product::latest()->get();
        return view('admin.backOffice.product.all_product',compact('products'));
    } //endmethod

    public function AddProduct(){

        $categories = Category::latest()->get();
        $products = Product::latest()->get();
        return view('admin.backOffice.product.add_product',compact('products', 'categories'));

    }//endmethod


    public function StoreProduct(Request $request){
        //dd($request->all());
        // Validate the incoming request data
        $validateData = $request->validate([
            'product_name' => 'required|unique:products|max:200',
            'category_id' => 'required|max:200',
            // 'supplier_id' => 'required|max:200',
            'meta_title' => 'required|max:200',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'product_store' => 'required|max:200',
            'product_description' => 'required',
            'product_features' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Added validation for image
        ]);
    
        // Generate slug from product name
        $slug = Str::slug($request->product_name);
    
        // Handle image upload
        $product_image = $request->file('product_image');
        $name_gen = $slug . '.' . $product_image->getClientOriginalExtension();
        Image::make($product_image)->resize(300, 398)->save(public_path('upload/products/' . $name_gen));
        $save_url = 'upload/products/' . $name_gen;
    
        // Generate product code
        $pcode = IdGenerator::generate(['table' => 'products', 'field' => 'product_code', 'length' => 6, 'prefix' => 'WABE']);
    
        // Insert product into database
        Product::insert([
            'product_name' => $request->product_name,
            'slug' => $slug,
            'category_id' => $request->category_id,
            // 'supplier_id' => $request->supplier_id,
            'brand_id' => 1,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'product_code' => $pcode,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $save_url,
            'product_store' => $request->product_store,
            'product_description' => $request->product_description,
            'product_features' => $request->product_features,
            'created_at' => Carbon::now(),
        ]);
    
        // Prepare notification
        $notification = [
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        ];
    
        // Redirect to the product listing page with a success message
        return redirect()->route('all.product')->with($notification);
    }//endmethod
    

      
    public function EditProduct($id){
        $product=Product::findOrfail($id);

        $categories = Category::latest()->get();
        // $suppliers = Supplier::latest()->get();

        return view('admin.backOffice.product.edit_product', compact('product', 'categories'));


    }

    public function UpdateProduct(Request $request)
    {
// dd($request->all());
        $product_id = $request->id;
        $slug = Str::slug($request->product_name); // Generate slug from the product name

        if ($request->file('product_image')) {

         $image = $request->file('product_image');
         $name_gen =  $slug.'.'. $image->getClientOriginalExtension();
         Image::make($image)->resize(300, 398)->save(public_path('upload/products/'.$name_gen));
         $save_url = 'upload/products/' . $name_gen;
         Product::findOrfail($product_id)->update([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            // 'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'meta_title'=> $request->meta_title,
            'meta_description'=> $request->meta_description,
                // 'buying_date' => $request->buying_date,
                // 'expire_date' => $request->expire_date,
            'product_image' => $save_url,
            'product_store'=>$request->product_store,
            'product_description'=>$request->product_description,
            'product_features'=>$request->product_features,
            'created_at' => Carbon::now(),
        ]);

         $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

         return redirect()->route('all.product')->with($notification);

     } else {
        Product::findOrfail($product_id)->update([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            // 'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'meta_title'=> $request->meta_title,
            'meta_description'=> $request->meta_description,
            // 'buying_date' => $request->buying_date,
            // 'expire_date' => $request->expire_date,
            'product_store'=>$request->product_store,
            'product_description'=>$request->product_description,
            'product_features'=>$request->product_features,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }
}


public function DeleteProduct($id){
    Product::findOrFail($id)->delete();

    $notification = array(
        'message' => 'Product Deleted Successfully',
        'alert-type' => 'warning'
    );

    return redirect()->back()->with($notification);
}

public function BarCodeProduct($id){

    $product=Product::findOrfail($id);

    return view('admin.backOffice.product.barcode_product', compact('product'));

}


public function ImportProduct(){
      //  $product=Product::findOrfail($id);
    return view('backoffice.product.import_product');

}


public function ExportProduct(){
    return Excel::download(new ProductExport, 'products.xlsx');
}

public function Import(Request $request)
{
    Excel::import(new ProductImport, $request->file('import_file'), null, \Maatwebsite\Excel\Excel::XLSX);


    $notification = array(
        'message' => 'Product File Imported Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);


}

////////////////////////////////Stock Management ///////////////////////////

public function OutofStock(){
    $outofstock_products = Product::where('product_store', '<=', 0)->get();
    return view('admin.backOffice.product.out_of_stock_product', compact('outofstock_products'));

}//endmethodhotProducts

public function ExpiredProducts(){
    $expired_products = Product::where('expire_date', '<=', \Carbon\Carbon::now()->format('Y-m-d'))->get();
    return view('admin.backOffice.product.expired_products', compact('expired_products'));
}//endmethod

public function GetHotProducts()
{
    $hotProducts = Product::where('sales_count', '>', 0)
    ->orderBy('sales_count', 'desc')
    ->limit(10)
    ->get();

    return view('admin.backOffice.product.hot-products', compact('hotProducts'));
}//endmethod




}
