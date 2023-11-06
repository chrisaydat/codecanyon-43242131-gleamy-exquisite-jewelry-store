<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;

class ProductController extends Controller
{
     public function index(){

        $pageTitle = 'All Products';
        $products = Product::orderBy('id','desc')->with('categories','producutImages')->paginate(getPaginate(20));
        return view('admin.products.index',compact('products','pageTitle'));

     }

     public function create(){
        $pageTitle = 'Add Product';
        $categories = Category::get();
        return view('admin.products.create',compact('categories','pageTitle'));
     }

     public function edit($id){
        $pageTitle = 'Update Product';
        $product = Product::find($id);
        $productImage = ProductImage::where('product_id', $id)->get();
        $categories = Category::get();
        return view('admin.products.edit',compact('productImage','categories','product','pageTitle'));

     }

     public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required',
            'quantity' => 'required',
            'images.*' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->purity = $request->purity;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->pergram_rate = $request->pergram_rate;
        $product->short_details = $request->short_details;
        $product->status = 1;
        Product::where('featured',1)->update(['featured'=> 0]);
        $product->featured = $request->featured;
        $product->save();


        foreach($request->images as $image){

            $productImage=new ProductImage();
            $productImage->product_id=$product->id;
              try {
                $directory = date("Y")."/".date("m");
                $productImage->url=$directory;
                $path  = getFilePath('productImages').'/'.$directory;
                $thumb = '150 x 150';
                $productImage->Image = fileUploader($image, $path, getFileSize('productImages'), $old=null, $thumb);
              } catch (\Exception $exp) {
                  $notify[] = ['error', 'Couldn\'t upload your image'];
                  return back()->withNotify($notify);
              }
              $productImage->save();

           }

           $notify[] = ['success', 'Product has been  created successfully'];
           return back()->withNotify($notify);

     }

     public function update(Request $request,$id){

        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required',
            'quantity' => 'required',
            'images.*' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->purity = $request->purity;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->pergram_rate = $request->pergram_rate;
        $product->short_details = $request->short_details;
        $product->status = $request->status ? 1 : 0;
        Product::where('featured',1)->update(['featured'=> 1]);
        $product->featured = $request->featured;
        $product->save();



        if ($request->hasFile('images')) {
            foreach($request->images as $image){
                $productImage=new ProductImage();
                $productImage->product_id=$product->id;

                  try {

                    $directory = date("Y")."/".date("m");
                    $productImage->url=$directory;
                    $path       = getFilePath('productImages').'/'.$directory;
                    $thumb = '150 x 150';
                    $productImage->Image = fileUploader($image, $path, getFileSize('productImages'), $old=null, $thumb);

                  } catch (\Exception $exp) {
                      $notify[] = ['error', 'Couldn\'t upload your image'];
                      return back()->withNotify($notify);
                  }
                  $productImage->save();

               }
            }

           $notify[] = ['success', 'Product has been  updated successfully'];
           return back()->withNotify($notify);

     }

     public function imageRemove(Request $request){
        $request->validate([
          'id' => 'required'
      ]);

      $image =  ProductImage::findOrFail($request->id);

      $directory = date("Y")."/".date("m");
      $path       = getFilePath('productImages');

      fileManager()->removeFile($path.'/'.$image->url .'/'.$image->image);
      fileManager()->removeFile($path.'/'.$image->url .'/'.'thumb_' .$image->image);
      $image->delete();
      $notify[] = ['success','Property Image has been deleted'];
      return back()->withNotify($notify);

      }

}
