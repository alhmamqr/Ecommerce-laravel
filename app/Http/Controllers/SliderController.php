<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $validateData = $request->validated();
         
        if($request->hasFile('image')){
            // $validateData['image'] = 'now';
            // return $validateData['image'];
            $file =$request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('upload/slider/',$fileName);
            $validateData['image'] = 'upload/slider/'.$fileName;
        }    
        Slider::create([
            'title'         =>$validateData['title'],
            'description'   =>$validateData['description'],
            'status'        =>$request->status==true ?'1':'0',
            'image'         =>$validateData['image']
        ]);
        return redirect('admin/slider')->with('message','success Added this item');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
        
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        //
        // return $request->status;
        $status = $request->status == true ?'1':'0';
         
        $fileExists = $slider->image;
        $validateData = $request->validated();
        if($request->hasFile('image')){
            // return 'ok';
              
            if(File::exists($fileExists)){
                File::delete($fileExists);
                 
            }
            $file =$request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('upload/slider/',$fileName);
            $validateData['image'] = 'upload/slider/'.$fileName;
        }    
        $slider->update([
            'title'=>$validateData['title'],
            'description'=>$validateData['description'],
            'status'=>$status ,
            'image'=>$validateData['image'] ?? $slider->image
        ]);
        return redirect('admin/slider')->with('message','success updated this item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        //
        
    }
    public function delete(Slider $slider){
        
        if($slider->count() >0){
            if(File::exists($slider->image)){
                File::delete($slider->image);
            }
        
        $slider->delete();
        return redirect('admin/slider')->with('message','success dlete this item');
        }
        return redirect('admin/slider')->with('message','wirng dlete this item');
    }
}
