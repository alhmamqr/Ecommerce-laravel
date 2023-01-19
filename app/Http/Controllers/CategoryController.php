<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryFormRequest;
use App\Models\Category; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    //
    public function index(){
        return view('admin.categories.index');
    }
    public function create(){
        return view('admin.categories.create');
    }
    public function store(CategoryFormRequest $request){


        $validateData = $request->validated();
        $cat = new Category();
        $cat->name = $validateData['name'];
        $cat->slug = Str::slug($validateData['slug']) ;
        $cat->description = $validateData['description'];
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext =$file->getClientOriginalExtension();
            $filename = time().".". $ext ;
            $file->move('upload/category/',$filename);
            $cat->image = 'upload/category/'.$filename;
        }

        $cat->meta_title = $validateData['meta_title'];
        $cat->meta_keyword = $validateData['meta_keyword'];
        $cat->meta_description = $validateData['meta_description'];
        $cat->status = $request['status']== true ? '1':'0';
        $cat->save();
        // return 'added';
        return redirect('admin/categories')->with('message','successfully Aded to category');
    }
    public function edit(Category $category){
        return view('admin.categories.edit',compact('category'));
    }
    public function update(CategoryFormRequest $request, $category){
        // return $category; 

        // return $request;
        $cat =Category::findOrFail($category); 
        $validateData = $request->validated();
        
        $cat->name = $validateData['name'];
        $cat->slug = Str::slug($validateData['slug']) ;
        $cat->description = $validateData['description'];
        if($request->hasFile('image')){
            $pathImage = $cat->image;
            if(File::exists($pathImage)){
                File::delete($pathImage);
            }
            $file = $request->file('image');
            $ext =$file->getClientOriginalExtension();
            $filename = time().".". $ext ;
            $file->move('upload/category/',$filename);
            $cat->image = 'upload/category/'.$filename;
        }
        
        $cat->meta_title = $validateData['meta_title'];
        $cat->meta_keyword = $validateData['meta_keyword'];
        $cat->meta_description = $validateData['meta_description'];
        $cat->status = $request['status']== true ? '1':'0';
        $cat->update();
        // return 'added';
        return redirect('admin/categories')->with('message','successfully updated to category');
    }
}
