<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
protected $paginationTheme = 'bootstrap';
    public $name,$slug,$status,$brand_id,$category_id;
    public function rules(){
        return
        [
            'name'=>'required',
            'slug'=>'required',
            'category_id'=>'required',
            'status'=>'nullable'
        ];
    }
    public function resetInput()
    {
        $this->brand_id =null;
        $this->name =null;   
        $this->slug =null;   
        $this->status =null;   
        $this->category_id =null;
    }
    public function storeBrand(){
        
        $validatedData = $this->validate();
     Brand::create([
        'category_id'=>$this->category_id,
        'name'=>$this->name,
        'slug'=>Str::slug($this->slug),
        'status'=> $this->status ==true ?'1':'0'
     ]);
     session()->flash('message','sucess Add Brands');
     $this->dispatchBrowserEvent('close-model');
     $this->resetInput();
    }

    public function editBrand($brand_id)
    {
        $this->brand_id=$brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->category_id=$brand->category_id;
    }
    public function closeModel(){
        $this->resetInput();
    }
    public function openModel(){
        
        $this->resetInput();
    }
    public function updateBrand(){
        $validatedData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
           'category_id'=>$this->category_id,
           'name'=>$this->name,
           'slug'=>Str::slug($this->slug),
           'status'=> $this->status ==true ?'1':'0'
        ]);
        session()->flash('message','success update Brands');
        $this->dispatchBrowserEvent('close-model');
        $this->resetInput();
         
    }
    public function deleteBrand($brand_id){
        $this->brand_id =$brand_id;
    }
    public function destroyBrand( ){
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message','success delete Brands');
        $this->dispatchBrowserEvent('close-model');
        $this->resetInput();
    }

    public function render()
    {
        $categories = Category::where('status','1')->get();
        $brands =Brand::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.brand.index',['brands'=>$brands,'categories'=>$categories])
        ->extends('layouts.admin')
        ->section('content');
    }
}
