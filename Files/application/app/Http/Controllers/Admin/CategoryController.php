<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
     public function index(){
        $pageTitle = 'All Categories';
        $categories = Category::orderBy('id','desc')->paginate(getPaginate(20));
        return view('admin.categories.index',compact('categories','pageTitle'));
     }

     public function store(Request $request){
        $request->validate([
            'name' => 'required|max:190|unique:categories',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        $category = new Category();
        $category->name = $request->name;

        if ($request->hasFile('image')) {
            try {
                $category->image = fileUploader($request->image, getFilePath('category'),getFileSize('category'));
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $category->save();
        $notify[] = ['success', 'Category has been  created successfully'];
        return back()->withNotify($notify);

     }

     public function update(Request $request){
        $request->validate([
            'name' => 'required|max:190',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $category = Category::find($request->id);
        $category->name = $request->name;

        $category->name = $request->name;
        if ($request->hasFile('image')) {
            try {
                $old = $category->image;
                $category->image = fileUploader($request->image, getFilePath('category'), getFileSize('category'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $category->save();
        $notify[] = ['success', 'Category has been  updated successfully'];
        return back()->withNotify($notify);

     }
}
