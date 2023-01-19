<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    //
    public function index(){
        $colors = Color::all();
        return view('admin.colors.index',compact('colors'));
        
    }
    public function create(){
        return view('admin.colors.create');
    }
    public function store(ColorRequest $request){
        $validateData =$request->validated();
        $color = Color::create([
            'color'=>$validateData['color'],
            'code'=>$validateData['code'],
            'status'=>$request->status ==true ?'1':'0'
            
        ]);
        return redirect('admin/colors')->with('message','success add color');
    }
    public function edit($id){
        $color =Color::findOrFail($id);
        return view('admin.colors.edit',compact('color'));
    }
    public function update(ColorRequest $request,$id){
        $validateData =$request->validated();
        Color::find($id)->update([
            'color'=>$validateData['color'],
            'code'=>$validateData['code'],
            'status'=>$request->status ==true ?'1':'0'
            
        ]);
        return redirect('admin/colors')->with('message','success update color');
    }
    public function delete($id){
        Color::find($id)->delete();
        return redirect('admin/colors')->with('message','success delete color');
    }
}
