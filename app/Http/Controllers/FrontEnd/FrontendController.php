<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public  function index(){
        $sliders =Slider::where('status','1')->get();
        $brands = Brand::all();
        $productTrending = Product::where('trending','1')->latest()->take(15)->get();
        $allProducts = Product::where('status','1')->latest()->get();

        return view('forntend.index',compact('sliders','productTrending','brands','allProducts'));
        }
        public function showCategories(){
            $categories = Category::where('status','1')->get();
            return view('forntend.category.index',compact('categories'));
        }


        public function  showProductWithSlug($category_slug){
            $category = Category::where('slug',$category_slug)->first();$category = Category::where('slug',$category_slug)->first();
            $brands =Brand::all();
            // return $category;
            // return $products =Product::where('category_id',$category->id)->get();
            if($category){
                 
                 
                return view('forntend.coolections.product.index',compact('brands','category' ));
            }else{
                return redirect()->back();
            }
            
        }
         public function showProductViewSlug($category_slug,$product_slug){

            $category = Category::where('slug',$category_slug)->first();
            $brands = Brand::all();
            if($category){
                $product =$category->products()->where('slug',$product_slug)->where('status','1')->first(); 
                if($product){
                    return view('forntend.coolections.product.view',compact('category','brands','product'));
                }else{
                    return redirect()->back();
                }
            }else{
                return redirect()->back();
            }
         }
         public function thankyou(){
            return view('forntend.thankyou');
         }
         
         public function arrivals(){
            $brands =Brand::all();
            $productTrending = Product::where('trending','1')->latest()->take(15)->get();
            return view('forntend.arrivals.arrivals-view',compact('productTrending','brands'));
         }
         public function searchProduct(Request $request){
            $brands = Brand::all();
            if($request->search){
                $searchProducts = Product::where('name','like','%'.$request->search.'%')->latest()->paginate(15);
                // return $searchProducts;
                return view('forntend.pages.search',compact('searchProducts','brands'));
            }else{
                return redirect()->back()->with('message','Empty Product serach');
            }
         }

         
}
