<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //

    public function index(){
        $products= Product::with('category')->get();
         
        return view('admin.product.index',compact('products'));
    }

    public function create(){
      $categories = Category::all();
      $brands =Brand::all();
      $colors =Color::all();
      
        return view('admin.product.create',compact('colors','categories','brands'));
    }


    public function store(StoreProductRequest $request){
        $validateData = $request->validated();

        $category =Category::findOrFail($validateData['category_id']);
        // return $category;
       $product = $category->products()->create([
                'category_id'        => $validateData['category_id'],
                'name'               =>$validateData['name'],
                'slug'               => Str::slug($validateData['slug']) ,
                'brand'              =>$validateData['brand'],
                'small_description'  =>$validateData['small_description'],
                'description'        =>$validateData['description'],
                'original_price'     =>$validateData['original_price'],
                'selling_price'      =>$validateData['selling_price'],
                'quantity'           =>$validateData['quantity'],
                'trending'           =>$request['trending'] == true ?'1':'0',
                'status'             =>$request['status'] == true ?'1':'0',
                'meta_title'         =>$validateData['meta_title'],
                'meta_keyword'       =>$validateData['meta_keyword'],
                'meta_description'   =>$validateData['meta_description']
        ]);

        if($request->hasFile('image')){
            $uploadPath='upload/products/';
            $i=1;
            foreach($request->file('image') as $imageFile){
                $ext = $imageFile->getClientOriginalExtension();
                $fileName=time().$i++.'.'.$ext;
                $imageFile->move($uploadPath,$fileName);
                $finelPathAndName=$uploadPath.$fileName;
                
                $product->productImages()->create([
                    'product_id'=>$product->id,
                    'image'=>$finelPathAndName,

                ]);
            }
        }
        if($request->colors){
            foreach($request->colors as $key =>$color){
                $product->productColors()->create([
                    'product_id'=>$product->id,
                    'color_id'=>$color,
                    'quantity'=>$request->color_quantity[$key] ?? 0
                ]);
            }
        }

        return redirect('admin/products')->with('message','successfully Added to products');
    }
    public function edit($id){
        $product =Product::findOrFail($id);
        // return $product;
        $categories=Category::all();
        $brands = Brand::all();
        $color = $product->productColors->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('id',$color)->get();
        $cc = ProductColor::with('color')->where('product_id',$id)->get();
        // foreach( $product->productColors as $pc){
        //     return $pc->color;
        // }
        // return $cc;
        return view('admin.product.edit',compact('colors','product','categories','brands'));
    }
    public function update(StoreProductRequest $request, $id){
        
         $validateData =$request->validated();
        $product =Category::findOrFail($validateData['category_id'])
        ->products()->where('id',$id)->first();
        if($product){
            $product->update([
                'category_id'        => $validateData['category_id'],
                'name'               =>$validateData['name'],
                'slug'               => Str::slug($validateData['slug']) ,
                'brand'              =>$validateData['brand'],
                'small_description'  =>$validateData['small_description'],
                'description'        =>$validateData['description'],
                'original_price'     =>$validateData['original_price'],
                'selling_price'      =>$validateData['selling_price'],
                'quantity'           =>$validateData['quantity'],
                'trending'           =>$request['trending'] == true ?'1':'0',
                'status'             =>$request['status'] == true ?'1':'0',
                'meta_title'         =>$validateData['meta_title'],
                'meta_keyword'       =>$validateData['meta_keyword'],
                'meta_description'   =>$validateData['meta_description']
            ]);
            if($request->hasFile('image')){
                $uploadPath='upload/products/';
                $i=1;
                foreach($request->file('image') as $imageFile){
                    $ext = $imageFile->getClientOriginalExtension();
                    $fileName=time().$i++.'.'.$ext;
                    $imageFile->move($uploadPath,$fileName);
                    $finelPathAndName=$uploadPath.$fileName;
                    
                    $product->productImages()->create([
                        'product_id'=>$product->id,
                        'image'=>$finelPathAndName,
    
                    ]);
                }
            }
            if($request->colors){
                foreach($request->colors as $key =>$color){
                    $product->productColors()->create([
                        'product_id'=>$product->id,
                        'color_id'=>$color,
                        'quantity'=>$request->color_quantity[$key] ?? 0
                    ]);
                }
            }

        }else{
            return redirect('admin/products')->with('message','soory not found that products'); return redirect('admin/products')->with('message','soory not found that products');
        }
        return redirect('admin/products')->with('message','upated successfaully that products');
    }
    public function delete($id){
        $product =Product::findOrFail($id);
        if($product->productImages){
            foreach($product->productImages as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect('admin/products')->with('message','success deleted that products');
    }
    public function updateProductColorQun(Request $request , $p_color_id){
        
        $productColors = Product::findOrFail($request->product_id)
        ->productColors()->where('id',$p_color_id)->first();
        $productColors->update([
            'quantity'=>$request->qty
        ]);
        return response()->json(['message'=>'success update quantity']);
    }
    public function deleteProductColorQun($p_color_id){
        
        $productColors = ProductColor::findOrFail($p_color_id);
        $productColors->delete(); 
        return response()->json(['message'=>'success delete quantity']);
    }
    
}
